<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page v-if="$route.name == 'comments'" :title="$t('global.show') + ' ' + $t('sidebar.all_comments')"></header-page>
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

                                        <!-- dataTables_filters -->
                                        <div class="dataTables_filters">

                                            <display
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></display>

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
import Display from "./../../components/dataTables/filters/Display";
import CreatedBetween from "./../../components/dataTables/filters/CreatedBetween";
import Search from "./../../components/dataTables/filters/Search";
import TableContent from "./TableContent";

import MixinsDatatable from "./../../mixins/MixinsDatatable"

export default {
    mixins: [MixinsDatatable],
    components: {
        Display,
        CreatedBetween,
        Search,
        TableContent
    },
  data() {
    let self = this;
    let sortOrders = {};
    let columns = [
      { label: "<i class='fa fa-plus'></i>", name: "show_plus" },
      { label: "#", name: "index" },
      { label: "ID", name: "id" },
      { label: "Comment", name: "text_comment" },
    //   { label: "Positive product", name: "positive_product" },
    //   { label: "Negative product", name: "negative_product" },
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
      idPage: 'comments',
      urlGetDataTable: '/comments',
      urlDeleteRow: '/comment/destroy',

      columns: columns,
      sortOrders: sortOrders,

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
            // "positive_product",
            // "negative_product",
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
      }
    };
  },
  methods: {
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
                to.meta.title = vm.$t('sidebar.comments')
                vm.setLocaleMessages()
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
            this.setLocaleMessages()
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
