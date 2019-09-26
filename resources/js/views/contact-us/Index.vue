<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('global.show') + ' ' + $t('sidebar.all_contact_us')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="dataTable" id="contact_us">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="dataTables_wrapper">
                                <div class="card">

                                    <!-- card-header -->
                                    <div class="card-header">

                                        <!-- dataTables_filters -->
                                        <div class="dataTables_filters">

                                            <created-between
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></created-between>

                                        </div><!-- ./dataTables_filters -->

                                        <!-- dataTables_header -->
                                        <div class="dataTables_header">

                                            <!-- Search -->
                                            <search
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></search>

                                            <!-- Filter columns -->
                                            <filters-columns
                                                @getData="getData"
                                                :columns="columns"
                                                :viewTableClasses="viewTableClasses"
                                                :tableData="tableData"
                                                :perPage="perPage"
                                            ></filters-columns>

                                            <!-- dataTables_buttons -->
                                            <div class="dataTables_buttons">

                                            </div>
                                            <!-- ./dataTables_buttons -->

                                        </div><!-- ./dataTables_header -->

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
import Search from "./../../components/dataTables/filters/Search";
import TableContent from "./TableContent";
import CreatedBetween from "./../../components/dataTables/filters/CreatedBetween";

import MixinsDatatable from "./../../mixins/MixinsDatatable"

export default {
    mixins: [MixinsDatatable],
    components: {
        Search,
        CreatedBetween,
        TableContent
    },
  data() {
    let self = this;
    let sortOrders = {};
    let columns = [
      { label: "<i class='fa fa-plus'></i>", name: "show_plus" },
      { label: "ID", name: "id" },
      { label: "Name", name: "name" },
      { label: "Email", name: "email" },
      { label: "Phone", name: "phone" },
      { label: "Message", name: "message" },
      { label: "Created at", name: "created_at" },
      { label: "Actions", name: "actions" }
    ];
    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      idPage: 'contact_us',
      urlGetDataTable: '/contact-us',
      urlDeleteRow: '/contact-us/destroy',
      columns: columns,
      sortOrders: sortOrders,
      tableData: {
        draw: 0,
        length: 10,
        search: "",
        column: 0,
        from_date: "",
        to_date: "",
        filter: {
          columns: [
            "index",
            "id",
            "name",
            "email",
            "phone",
            "message",
            "created_at",
            "actions"
          ],
          columnsExcept: ['show_plus', 'index', 'message', 'actions'],
          viewTable: ["bordered", 'hover']
        },
        dir: ""
      },
      // viewFilterColumns
      viewColumnsResponsive: {
        default: {
          show: "all"
        },
        1000: {
          show: ['name', 'email', 'message', 'actions']
        },
        800: {
          show: ['name', 'email', 'message']
        },
        600: {
          show: ['name', 'email']
        },
        400: {
          show: ['name']
        }
      }
    };
  },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.contact_us')
            vm.setLocaleMessages()
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
