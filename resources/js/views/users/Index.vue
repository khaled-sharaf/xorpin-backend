<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page v-if="this.$route.name == 'users'" :title="$t('global.show') + ' ' + $t('sidebar.all_users')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="dataTable" id="users">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="dataTables_wrapper">
                                <div class="card">

                                    <!-- card-header -->
                                    <div class="card-header">

                                        <!-- dataTables_filters -->
                                        <div class="dataTables_filters">

                                            <trashed
                                                v-if="this.$route.name != 'product-profile' && $gate.isAdmin()"
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></trashed>

                                            <activation
                                                v-if="$gate.isAdmin()"
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></activation>

                                            <rules
                                                v-if="this.$route.name == 'users'"
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></rules>

                                            <created-between
                                                v-if="$gate.isAdmin()"
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
                                                <router-link
                                                    tag="button"
                                                    :to="{name: 'create-user'}"
                                                    type="button"
                                                    class="btn btn-outline-secondary"
                                                    v-if="this.$route.name == 'users'"
                                                >
                                                    {{ $t('global.create') }}
                                                    <i class="fa fa-plus fa-fw"></i>
                                                </router-link>
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
        </section>
    </div>
</template>



<script>
import Trashed from "./../../components/dataTables/filters/Trashed";
import Activation from "./../../components/dataTables/filters/Activation";
import Rules from "./../../components/dataTables/filters/Rules";
import CreatedBetween from "./../../components/dataTables/filters/CreatedBetween";
import Search from "./../../components/dataTables/filters/Search";
import TableContent from "./TableContent";

import MixinsDatatable from "./../../mixins/MixinsDatatable"

export default {
    mixins: [MixinsDatatable],
    components: {
        Trashed,
        Activation,
        Rules,
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
        { label: "Name", name: "name" },
        { label: "Email", name: "email" },
        { label: "Mobile", name: "phone" },
        { label: "Address", name: "address" },
        { label: "Avatar", name: "photo" },
        { label: "Rule", name: "rule" },
        { label: "Active", name: "active" },
        { label: "Registered", name: "created_at" },
        { label: "Company", name: "company" },
        { label: "Actions", name: "actions" }
    ];
    columns.forEach(column => {
        sortOrders[column.name] = -1;
    });
    return {
        idPage: 'users',
        urlGetDataTable: '/users',
        urlDeleteRow: '/user/destroy',
        urlRestoreRow: '/user/restore',

        columns: columns,
        sortOrders: sortOrders,

        tableData: {
            companyId: null,
            draw: 0,
            length: 10,
            search: "",
            column: 0,
            rule: "",
            active: "",
            trashed: 1,
            from_date: "",
            to_date: "",
            filter: {
                // columns of filter sorting [in select menu]
                columns: [
                    "index",
                    "id",
                    "name",
                    "email",
                    "phone",
                    "addresss",
                    "photo",
                    "rule",
                    "active",
                    "created_at",
                    "company",
                    "actions"
                ],
                // columns excepted sorting
                columnsExcept: ["index", "actions", "show_plus", 'company', 'photo'],
                viewTable: ["bordered", 'hover']
            },
            dir: ""
        },
      // viewFilterColumns
        viewColumnsResponsive: {
            default: {
                //   show: "all",// or ['id', 'index']
                //   hide: ['index', 'photo', 'rule', 'active']
                hide: ['index', 'rule', 'active']
            },
            1200: {
                hide: ['index', 'created_at', 'photo', 'rule', 'active']
            },
            1000: {
                show: ['id', "name", "email", "phone", "address", 'actions']
            },
            800: {
                show: ["name", "email", 'phone', "actions"]
            },
            600: {
                show: ["name", "actions"]
            },
            400: {
                show: ["name"]
            }
        },
    };
  },
  methods: {
    addCompanyIdToRequest() {
        const companyId = this.$route.params.id;
        if (companyId != null) {
            this.tableData.companyId = companyId
        }
        this.viewColumnsResponsive.default.hide = ['index', 'id', 'created_at', 'company', 'rule', 'actions']
    },
    addProductIdToRequest() {
        const product_id = this.$route.params.id;
        if (product_id != null) {
            this.tableData.winners = true
            this.tableData.winners_product_id = product_id
        }
        this.viewColumnsResponsive.default.hide = ['index', 'id', 'created_at', 'company', 'rule', 'actions']
    }
  },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (to.name == 'users') {
                to.meta.title = vm.$t('sidebar.users')
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
        if (this.$route.name == 'company-profile') {
            this.addCompanyIdToRequest() // add company id to table data for get users of company by company id for to use in company profile
        }
        if (this.$route.name == 'product-profile') {
            this.addProductIdToRequest()
        }
        if (this.$route.name != 'users') {
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

