<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="View all companies"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <!-- <router-link :to="{name: 'create-user'}">Create User</router-link>
            <router-link :to="{name: 'edit-user', params: {id: '1'}}">Edit User 1</router-link> -->
            <div class="container-fluid">
                <div class="dataTable" id="companies">
                    <div class="row mt-3">
                        <div class="col-12">
                            <!-- <alert-success v-if="form.successful" :form="form" :message="messageSuccessfulCreateUser"></alert-success> -->
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
                                                    @restoreRow="restoreRow"
                                                    @forceDeleteRow="forceDeleteRow"
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

            <!-- modal location company -->

            <modal-location></modal-location>

            <!-- ./modal location company -->
        </section>
    </div>
</template>


<script>
import HeaderPage from './../../components/HeaderPage'
import TableWrapper from "./../../components/dataTables/TableWrapper"
import TableHeaderFilters from "./TableHeaderFilters"
import TableContent from "./TableContent"
import Pagination from "./../../components/dataTables/Pagination"
import ModalLocation from "./ModalLocation"

export default {
  components: {
    HeaderPage,
    tableHeaderFilters: TableHeaderFilters,
    tableWrapper: TableWrapper,
    pagination: Pagination,
    tableContent: TableContent,
    modalLocation: ModalLocation
  },
  data() {
    let self = this;
    let sortOrders = {};
    let columns = [
      { label: "<i class='fa fa-plus'></i>", name: "show_plus" },
      { label: "#", name: "index" },
      { label: "ID", name: "id" },
      { label: "Name", name: "name" },
      { label: "Email", name: "email" },
      { label: "Mobile", name: "phone" },
      { label: "Address", name: "address" },
      { label: "Website", name: "website" },
      { label: "Description", name: "description" },
      { label: "Logo", name: "logo" },
      { label: "Rates", name: "count_rates" },
      { label: "Location", name: "location" },
      { label: "Facebook", name: "face_link" },
      { label: "Twitter", name: "tw_link" },
      { label: "Display", name: "display" },
      { label: "Active", name: "active" },
      { label: "Registered", name: "created_at" },
      { label: "Actions", name: "actions" }
    ];
    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      urlGetDataTable: '/companies',
      urlDeleteRow: '/company/destroy',
      urlRestoreRow: '/company/restore',
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
        active: "",
        trashed: 1,
        from_date: "",
        to_date: "",
        filter: {
          columns: [
            "index",
            "id",
            "name",
            "email",
            "phone",
            "addresss",
            "website",
            "description",
            "logo",
            "count_rates",
            "location",
            "face_link",
            "tw_link",
            "display",
            "active",
            "created_at",
            "actions"
          ],
          columnsExcept: ['show_plus', 'index', 'actions', 'location', 'logo'],
          viewTable: ["bordered", 'hover']
        },
        dir: ""
      },
      // viewFilterColumns
      viewColumnsResponsive: {
        default: {
        //   show: "all",// or ['id', 'index']
          show: ['name', 'phone', 'address', 'logo', 'count_rates', '', 'actions']
        },
        1200: {
          show: ['name', 'phone', 'logo', 'count_rates', 'actions']
        },
        1000: {
          show: ['name', 'logo', 'count_rates', 'actions']
        },
        800: {
          show: ['name', 'logo', 'actions']
        },
        600: {
          show: ["name", "actions"]
        },
        400: {
          show: ["name"]
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
      this.tableData.draw++;
      axios
        .post(url, this.tableData)
        .then(response => {
          let data = response.data,
            self = this;
          if (this.tableData.draw == data.draw) {
            if (response.status === 200) {
              this.dataTable = data.data.data;
              this.configPagination(data.data);
              setTimeout(function() {
                self.updateRowDataWhenGet();
              }, 200);
            }
          }
        })
        .catch(errors => {
          this.$Progress.fail();
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
        $("#companies.dataTable .btn-show-more-row")
          .removeClass("active")
          .find("i")
          .removeClass("fa-minus")
          .addClass("fa-plus");
      }, 200);
    },
    showMap(lat, long) {
        if (lat != null && long != null) {
            var my_map_modal = $('#my_map_modal');
            my_map_modal.attr('data-lat', lat).attr('data-long', long);
            var scriptMap = document.createElement('script');
            document.body.appendChild(scriptMap);
            scriptMap.id = 'myScriptMap';
            scriptMap.setAttribute('async', true);
            scriptMap.setAttribute('defer', true);
            scriptMap.setAttribute('src', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyADsFcbM6g-A_nUwh41pFn9EgDdlRC6lGY&language=ar&region=EG&callback=initMap');
        }
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

    // function => restore row [this btn in table data hide]
      $(document).on(
        "click",
        ".table tbody .tr-table-data td .btn-restore-row",
        function(e) {
          e.preventDefault();
          let id = $(this)
            .parents(".tr-table-data")
            .prev("tr")
            .attr("data-id");
          self.restoreRow(id);
        }
      );

      // show location in google map
        $(document).on("click", "#show_map_location", function(e) {
            e.preventDefault();
            let lat = $(this).attr('data-lat'),
                long = $(this).attr('data-long'),
                title = $(this).attr('data-location-title');
            if ( (typeof lat != 'undefined' && lat != '' && lat != null) &&
                (typeof long != 'undefined' && long != '' && long != null) ) {
                $('#locationTitle').html('Location: ' + title);
                $('#myScriptMap').remove();
                self.showMap(lat, long);
                $('#modal_location_company').modal('show');
            }
        });
    },
    destroyRow(id) {
      Swal.fire({
        title: "Delete",
        text: "Are you sure you want to delete this company?",
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
                Swal.fire("Deleted!", "The company has been deleted.", "success");
                this.getData();
              }
            })
            .catch(error => {
              Swal.fire("Failed!", "The company has not been deleted.", "error");
              this.$Progress.fail();
            });
        }
      });
    },

    forceDeleteRow(id) {
      Swal.fire({
        title: "Force Delete",
        text: "Are you sure you want to remove this company?",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#e74c3c",
        cancelButtonColor: "#6d6d6d",
        confirmButtonText: "Yes, remove it!"
      }).then(result => {
        if (result.value) {
          loadReq(this.$Progress);
          axios
            .post(this.urlDeleteRow, {id: id})
            .then(response => {
              if (response.status === 200) {
                Swal.fire("Removed!", "The company has been removed.", "success");
                this.getData();
              }
            })
            .catch(error => {
              Swal.fire("Failed!", "The company has not been removed.", "error");
              this.$Progress.fail();
            });
        }
      });
    },
    restoreRow(id) {
      Swal.fire({
        title: "Restore",
        text: "Are you sure you want to restore this company?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#6cb2eb",
        cancelButtonColor: "#6d6d6d",
        confirmButtonText: "Yes, restore it!"
      }).then(result => {
        if (result.value) {
          loadReq(this.$Progress);
          axios
            .post(this.urlRestoreRow, {id: id})
            .then(response => {
              if (response.status === 200) {
                Swal.fire("Restored!", "The company has been restored.", "success");
                this.getData();
              }
            })
            .catch(error => {
              Swal.fire("Failed!", "The company has not been restored.", "error");
              this.$Progress.fail();
            });
        }
      });
    },

  },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            vm.sortOrders[vm.sortKey] = 1; // 1 = desc , -1 = asc
            vm.sortBy(vm.sortKey);
            vm.eventBtnsClick();
            vm.viewFilterColumns();
            window.onresize = () => {
                vm.viewFilterColumns();
            };
        })
    },
};
</script>
<style scoped lang="scss">

</style>
