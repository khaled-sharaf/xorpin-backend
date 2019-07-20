
import TableWrapper from "./../components/dataTables/TableWrapper";
import HeaderPage from './../components/HeaderPage'
import FiltersColumns from "./../components/dataTables/filters/FiltersColumns";
import Pagination from "./../components/dataTables/Pagination";

export default {
    components: {
        TableWrapper,
        HeaderPage,
        FiltersColumns,
        Pagination,
    },
    data() {
        return {
            successResponse: false,
            dataTable: [],
            sortKey: "id",

            viewTableClasses: [
                "responsive",
                "dark",
                "light",
                "hover",
                "striped",
                "bordered",
                "borderless",
                "sm"
            ],
            perPage: [5, 10, 15, 20, 25, 50, 100],
            pagination: {
                lastPage: "",
                currentPage: "",
                total: "",
                lastPageUrl: "",
                nextPageUrl: "",
                prevPageUrl: "",
                from: "",
                to: ""
            }
        }
    },
    watch: {
        "tableData.from_date"(val) {
            this.getData();
        },
        "tableData.to_date"(val) {
            this.getData();
        },
        "tableData.filter.columns.length"(val) {
            let self = this;
            $(".tr-table-data").children("td").attr("colspan", val + 1);
            $(".table tbody tr.tr-general").each(function() {
                let id = $(this).attr("data-id");
                $(this).next(".tr-table-data").find("td").html(self.viewDataExcepted(id));
            });
        },
    },
    computed: {
        columnsExcept() {
            let arr = [];
            for (let col in this.columns) {
                let name = this.columns[col].name;
                if (this.tableData.filter.columns.indexOf(name) == -1 &&
                    name != "show_plus" &&
                    name != "index") {
                    arr.push(name);
                }
            }
            return arr;
        }
    },
    methods: {
        getData(url = this.urlGetDataTable) {
            loadReq(this.$Progress);
            this.successResponse = false
            this.tableData.draw++;
            axios.post(url, this.tableData).then(response => {
                let data = response.data,
                    self = this;
                if (this.tableData.draw == data.draw) {
                    if (response.status === 200) {
                        this.dataTable = data.data.data;
                        this.successResponse = true
                        this.configPagination(data.data);
                        setTimeout(function() {
                            self.updateRowDataWhenGet();
                        }, 200);
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getData()
                }, 1000)
                this.$Progress.fail()
            });
        },
        gotopage(value) {
            this.getData(this.urlGetDataTable + "?page=" + value);
        },
        // get data
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, "name", key) - 1;
            this.tableData.dir = this.sortOrders[key] == 1 ? "asc" : "desc";
            this.getData();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value);
        },
        viewFilterColumns() {
            let obj = this.viewColumnsResponsive,
                allScreenSizes = [],
                allColumns = [],
                defaultColumns = [];
            for (let col in this.columns) {
                if (this.columns[col].name != "show_plus") {
                    allColumns.push(this.columns[col].name);
                }
            }
            if (obj.default && obj.default.show) {
                if (
                typeof obj.default.show == "string" &&
                obj.default.show.toLowerCase() == "all"
                ) {
                defaultColumns = allColumns;
                } else if (typeof obj.default.show == "object") {
                    defaultColumns = obj.default.show;
                }
            } else if (
                obj.default &&
                obj.default.hide &&
                typeof obj.default.hide == "object"
            ) {
                let defaultHideColumns = [];
                for (let colRemove in obj.default.hide) {
                    defaultHideColumns = allColumns;
                    let index = defaultHideColumns.indexOf(obj.default.hide[colRemove]);
                    if (index != -1) {
                        defaultHideColumns.splice(index, 1);
                    }
                }
                defaultColumns = defaultHideColumns;
            } else {
                defaultColumns = allColumns;
            }
            for (let screenNumber in obj) {
                if (screenNumber != "default") {
                    if (!isNaN(screenNumber % 1)) {
                        screenNumber = parseInt(screenNumber);
                        allScreenSizes.push(screenNumber);
                    }
                }
            }
            let maxMedia = Math.max(...allScreenSizes),
                minMedia = Math.min(...allScreenSizes);
            for (let size in allScreenSizes) {
                size = parseInt(size);
                let keyMediaNumber = allScreenSizes[size];
                let numPx = "";
                if (allScreenSizes.length != size + 1) {
                numPx = window.matchMedia(
                    "(max-width: " +
                    allScreenSizes[size + 1] +
                    "px) and (min-width: " +
                    keyMediaNumber +
                    "px)"
                );
                } else {
                numPx = window.matchMedia("(max-width: " + minMedia + "px)");
                }
                let bigSizeMedia = window.matchMedia("(min-width: " + maxMedia + "px)");
                if (numPx.matches) {
                let currentScreen =
                    typeof allScreenSizes[size + 1] != "undefined"
                    ? allScreenSizes[size + 1]
                    : minMedia;
                for (let typeArr in obj[currentScreen]) {
                    if (typeArr == "show") {
                    this.tableData.filter.columns = obj[currentScreen][typeArr];
                    } else if (typeArr == "hide") {
                    for (let colRemove in obj[currentScreen][typeArr]) {
                        this.tableData.filter.columns = allColumns;
                        let index = this.tableData.filter.columns.indexOf(
                        obj[currentScreen][typeArr][colRemove]
                        );
                        if (index != -1) {
                        this.tableData.filter.columns.splice(index, 1);
                        }
                    }
                    }
                }
                } else if (bigSizeMedia.matches) {
                    this.tableData.filter.columns = defaultColumns;
                }
            }
        },
        viewDataExcepted(id) {
            let list = "";
            id = parseInt(id);
            for (let col in this.dataTable) {
                if (this.dataTable[col].id == id) {
                list = "<ul>";
                for (let columnName in this.columnsExcept) {
                    let colName = this.columnsExcept[columnName];
                    for (let colNative in this.columns) {
                    if (this.columns[colNative].name == colName) {
                        let colLabel = this.columns[colNative].label;
                        list += `<li> <span class="label">${colLabel}</span> ${$(
                        ".table tbody tr[data-id='" +
                            id +
                            "'] td." +
                            this.columnsExcept[columnName]
                        ).html()} </li>`;
                    }
                    }
                }
                list += "</ul>";
                }
            }
            return list;
        },
        updateRowDataWhenGet() {
            let self = this;
            $(".table tbody tr.tr-table-data").each(function(i) {
                $(this).remove();
            });
            setTimeout(() => {
                $(".table tbody tr.tr-general").each(function(i) {
                let id = $(this).attr("data-id");
                $(this).after(
                    `<tr class="tr-table-data"><td colspan="${self.tableData
                        .filter.columns.length + 1}">
                        ${self.viewDataExcepted(id)}
                    </td></tr>`);
                });
                $(".tr-table-data").hide();
                $(`#${self.idPage}.dataTable .btn-show-more-row`).removeClass("active").find("i").removeClass("fa-minus").addClass("fa-plus");
            }, 200);
        },
        eventBtnsClick() {
            let self = this;
            // delete row from columns excepted
            $(document).on("click", ".table tbody .tr-table-data td .btn-delete-row",
                function(e) {
                    e.preventDefault();
                    let id = $(this).parents(".tr-table-data").prev("tr").attr("data-id");
                    if ($(this).hasClass('force-delete')) {
                        self.forceDeleteRow(id);
                    } else {
                        self.destroyRow(id);
                    }
                }
            );
            // function => restore row [this btn in table data hide]
            $(document).on("click", ".table tbody .tr-table-data td .btn-restore-row",
                function(e) {
                    e.preventDefault();
                    let id = $(this).parents(".tr-table-data").prev("tr").attr("data-id");
                    self.restoreRow(id);
                }
            );
        },

        destroyRow(id) {
            Swal.fire({
                title: this.$t('global.delete'),
                text: this.delete_msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e74c3c",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.$t('global.yes_delete_it') + "!"
            }).then(result => {
                if (result.value) {
                loadReq(this.$Progress);
                axios
                    .post(this.urlDeleteRow, {id: id})
                    .then(response => {
                    if (response.status === 200) {
                        Swal.fire(this.$t('global.deleted') + "!", this.delete_success_msg, "success");
                        this.getData();
                    }
                    })
                    .catch(error => {
                    Swal.fire(this.$t('global.failed') + "!", this.delete_failed_msg, "error");
                    this.$Progress.fail();
                    });
                }
            });
        },

        forceDeleteRow(id) {
            Swal.fire({
                title: this.$t('global.force_delete'),
                text: this.force_delete_msg,
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#e74c3c",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.$t('global.yes_remove_it') + "!"
            }).then(result => {
                if (result.value) {
                loadReq(this.$Progress);
                axios
                    .post(this.urlDeleteRow, {id: id})
                    .then(response => {
                    if (response.status === 200) {
                        Swal.fire(this.$t('global.removed') + "!", this.force_delete_success_msg, "success");
                        this.getData();
                    }
                    })
                    .catch(error => {
                    Swal.fire(this.$t('global.failed') + "!", this.force_delete_failed_msg, "error");
                    this.$Progress.fail();
                    });
                }
            });
        },
        restoreRow(id) {
            Swal.fire({
                title: this.$t('global.restore'),
                text: this.restore_msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#6cb2eb",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.$t('global.yes_restore_it') + "!"
            }).then(result => {
                if (result.value) {
                loadReq(this.$Progress);
                axios
                    .post(this.urlRestoreRow, {id: id})
                    .then(response => {
                    if (response.status === 200) {
                        Swal.fire(this.$t('global.restored') + "!", this.restore_success_msg, "success");
                        this.getData();
                    }
                    })
                    .catch(error => {
                    Swal.fire(this.$t('global.failed') + "!", this.restore_failed_msg, "error");
                    this.$Progress.fail();
                    });
                }
            });
        },

    }
}
