<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page v-if="$route.name == 'comments'" title="View all comments"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="dataTable" id="comments">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="dataTables_wrapper">
                                <div class="card">

                                    <!-- card-header -->
                                    <div class="card-header">

                                        <table-header-filters
                                            @getData="getData"
                                            :columns="columns"
                                            :viewTableClasses="viewTableClasses"
                                            :tableData="tableData"
                                            :perPage="perPage"
                                        ></table-header-filters>

                                    </div>
                                    <!-- /.card-header -->

                                    <div class="card-body table-responsive">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table-wrapper
                                                    :successResponse="successResponse"
                                                    :dataTable="dataTable"
                                                    :columns="columns"
                                                    :columnsView="tableData.filter.columns"
                                                    :columnsExcepted="tableData.filter.columnsExcept"
                                                    :viewtableclasses="tableData.filter.viewTable"
                                                    :sortKey="sortKey"
                                                    :sortOrders="sortOrders"
                                                    @sort="sortBy"
                                                >
                                                    <table-content
                                                        :dataTable="dataTable"
                                                        :tableData="tableData"
                                                        @destroyRow="destroyRow"
                                                    ></table-content>

                                                </table-wrapper>
                                            </div> <!-- ./ col-sm-12 -->
                                        </div> <!-- ./ row -->
                                    </div> <!-- /.card-body -->

                                    <!-- card-footer -->
                                    <div class="card-footer">
                                        <div class="row-pagination">
                                            <pagination
                                                :pagination="pagination"
                                                :totalLink="Math.ceil(pagination.total / tableData.length)"
                                                @prev="getData(pagination.prevPageUrl)"
                                                @next="getData(pagination.nextPageUrl)"
                                                @gotopage="gotopage"
                                            ></pagination>
                                        </div>
                                    </div> <!-- /.card-footer -->
                                </div> <!-- /.card -->
                            </div> <!-- /.datatables wrapper -->
                        </div><!-- /.col-12 -->
                    </div> <!-- /.row -->
                </div> <!-- /.dataTable -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
import HeaderPage from './../../components/HeaderPage'
import TableWrapper from "./../../components/dataTables/TableWrapper"
import TableHeaderFilters from "./TableHeaderFilters"
import TableContent from "./TableContent"
import Pagination from "./../../components/dataTables/Pagination"

export default {
  components: {
    HeaderPage,
    tableHeaderFilters: TableHeaderFilters,
    tableWrapper: TableWrapper,
    pagination: Pagination,
    tableContent: TableContent
  },
  data() {
    let self = this;
    let sortOrders = {};
    let columns = [
      { label: "<i class='fa fa-plus'></i>", name: "show_plus" },
      { label: "#", name: "index" },
      { label: "ID", name: "id" },
      { label: "Comment", name: "text_comment" },
      { label: "Positive product", name: "positive_product" },
      { label: "Negative product", name: "negative_product" },
      { label: "Username", name: "user_id" },
      { label: "Product name", name: "product_id" },
      { label: "Display", name: "display" },
      { label: "Created at", name: "created_at" },
      { label: "Actions", name: "actions" }
    ];
    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      urlGetDataTable: '/comments',
      urlDeleteRow: '/comment/destroy',
      successResponse: false,
      dataTable: [],
      columns: columns,
      sortKey: "id",
      sortOrders: sortOrders,
      perPage: [5, 10, 15, 20, 25, 50, 100],
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
      tableData: {
        draw: 0,
        length: 10,
        search: "",
        column: 0,
        display: "",
        trashed: 1,
        from_date: "",
        to_date: "",
        filter: {
          columns: [
            "index",
            "id",
            "text_comment",
            "positive_product",
            "negative_product",
            "display",
            "user_id",
            "product_id",
            "created_at",
            "actions"
          ],
          columnsExcept: ['show_plus', 'index'],
          viewTable: ["bordered", 'hover']
        },
        dir: ""
      },
      // viewFilterColumns
      viewColumnsResponsive: {
        default: {
        //   show: "all",// or ['id', 'index']
          hide: ['index']
        },
        // 1200: {
        //   show: ['name', 'phone', 'logo', 'count_rates', 'actions']
        // },
        1000: {
          show: ['text_comment', 'user_id', 'product_id', 'created_at', 'actions']
        },
        800: {
          show: ['text_comment', 'user_id', 'product_id', 'created_at']
        },
        600: {
          show: ["text_comment", "user_id"]
        },
        400: {
          show: ["text_comment"]
        }
      },
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
    };
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
      $(".tr-table-data")
        .children("td")
        .attr("colspan", val + 1);
      $(".table tbody tr.tr-general").each(function() {
        let id = $(this).attr("data-id");
        $(this)
          .next(".tr-table-data")
          .find("td")
          .html(self.viewDataExcepted(id));
      });
    },
  },
  computed: {
    columnsExcept() {
      let arr = [];
      for (let col in this.columns) {
        let name = this.columns[col].name;
        if (
          this.tableData.filter.columns.indexOf(name) == -1 &&
          name != "show_plus" &&
          name != "index"
        ) {
          arr.push(name);
        }
      }
      return arr;
    }
  },
  methods: {
    gotopage(value) {
      this.getData(this.urlGetDataTable + "?page=" + value);
    },
    getData(url = this.urlGetDataTable) {
      loadReq(this.$Progress);
      this.successResponse = false
      this.tableData.draw++;
      axios
        .post(url, this.tableData)
        .then(response => {
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
        </td></tr>`
          );
        });
        $(".tr-table-data").hide();
        $("#comments.dataTable .btn-show-more-row")
          .removeClass("active")
          .find("i")
          .removeClass("fa-minus")
          .addClass("fa-plus");
      }, 200);
    },
    eventBtnsClick() {
      let self = this;
      // delete row from columns excepted
      $(document).on("click", ".table tbody .tr-table-data td .btn-delete-row", function(e) {
        e.preventDefault();
        let id = $(this)
            .parents(".tr-table-data")
            .prev("tr")
            .attr("data-id");
        if ($(this).hasClass('force-delete')) {
            self.forceDeleteRow(id);
        } else {
            self.destroyRow(id);
        }
        }
      );
    },
    destroyRow(id) {
      Swal.fire({
        title: "Delete",
        text: "Are you sure you want to delete this comment?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#e74c3c",
        cancelButtonColor: "#6d6d6d",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          loadReq(this.$Progress);
          axios
            .post(this.urlDeleteRow, {id: id})
            .then(response => {
              if (response.status === 200) {
                Swal.fire("Deleted!", "The comment has been deleted.", "success");
                this.getData();
              }
            })
            .catch(error => {
              Swal.fire("Failed!", "The comment has not been deleted.", "error");
              this.$Progress.fail();
            });
        }
      });
    },
    addProductIdToRequest() {
        const productId = this.$route.params.id;
        if (productId != null) {
            this.tableData.productId = productId
        }
        this.viewColumnsResponsive.default.hide = ['index', 'id', 'display', 'actions', 'product_id', 'created_at']
    },
  },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (vm.$route.name == 'comments') {
                vm.sortOrders[vm.sortKey] = 1; // 1 = desc , -1 = asc
                vm.sortBy(vm.sortKey);
                vm.eventBtnsClick();
                vm.viewFilterColumns();
                window.onresize = () => {
                    vm.viewFilterColumns();
                };
            }
        })
    },
    mounted() {
        if (this.$route.name == 'product-profile') {
            this.addProductIdToRequest()
        }
        if (this.$route.name != 'comments') {
            this.sortOrders[this.sortKey] = 1; // 1 = desc , -1 = asc
            this.sortBy(this.sortKey);
            this.eventBtnsClick();
            this.viewFilterColumns();
            window.onresize = () => {
                this.viewFilterColumns();
            };
        }
    },
};
</script>
<style scoped lang="scss">

</style>
