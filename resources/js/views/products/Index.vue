<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page v-if="$route.name == 'products'" :title="$t('global.show') + ' ' + $t('sidebar.all_products')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="dataTable" id="products">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="dataTables_wrapper">
                                <div class="card">

                                    <!-- card-header -->
                                    <div class="card-header">

                                        <!-- dataTables_filters -->
                                        <div class="dataTables_filters">

                                            <trashed
                                                v-if="$gate.isAdmin()"
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></trashed>

                                            <sold-out
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></sold-out>

                                            <display
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></display>

                                            <discount
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></discount>

                                            <products-type
                                                @getData="getData"
                                                :tableData="tableData"
                                                :proTypes="proTypes"
                                            ></products-type>

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
                                                <router-link
                                                    :to="{name: 'create-product'}" tag="button"
                                                    type="button"
                                                    class="btn btn-outline-secondary"
                                                    v-if="this.$route.name == 'products'"
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
                                                        @sellProduct="sellProduct"
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
import SoldOut from "./../../components/dataTables/filters/SoldOut";
import Display from "./../../components/dataTables/filters/Display";
import Discount from "./../../components/dataTables/filters/Discount";
import ProductsType from "./../../components/dataTables/filters/ProductsType";
import CreatedBetween from "./../../components/dataTables/filters/CreatedBetween";
import Search from "./../../components/dataTables/filters/Search";
import TableContent from "./TableContent";

import MixinsDatatable from "./../../mixins/MixinsDatatable"
import MixinsSellProduct from "./../../mixins/MixinsSellProduct"

export default {
    mixins: [MixinsDatatable, MixinsSellProduct],
        components: {
        Trashed,
        SoldOut,
        Display,
        Discount,
        ProductsType,
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
      { label: "Image", name: "photo" },
      { label: "Price", name: "price" },
      { label: "Description", name: "description" },
      { label: "Manufacture company", name: "manufacture_company" },
      { label: "Rates", name: "count_rates" },
      { label: "Counts", name: "product_count" },
      { label: "Count of selling", name: "count_selling" },
      { label: "Sold out", name: "execute" },
      { label: "Display", name: "display" },
      { label: "Category", name: "type" },
      { label: "Craeted by", name: "user" },
      { label: "Created company by", name: "company" },
      { label: "Last modified", name: "updated_at" },
      { label: "Created at", name: "created_at" },
      { label: "Actions", name: "actions" }
    ];
    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      idPage: 'products',
      urlGetDataTable: '/products',
      urlDeleteRow: '/product/destroy',
      urlRestoreRow: '/product/restore',
      urlSellProduct: '/product/sell',
      urlGetProductsTypes: '/pro-types-data',

      proTypes: [],
      columns: columns,
      sortOrders: sortOrders,

      tableData: {
        draw: 0,
        length: 10,
        search: "",
        column: 0,
        execute: "0",
        type_id: "",
        display: "",
        trashed: "1",
        discount: "",
        from_date: "",
        to_date: "",
        filter: {
          columns: [
            'index',
            'id',
            'name',
            'photo',
            'price',
            'description',
            'manufacture_company',
            'count_rates',
            'product_count',
            'count_selling',
            'execute',
            'display',
            'type',
            'user',
            'company',
            'updated_at',
            'created_at',
            'actions'
        ],
          columnsExcept: ['show_plus', 'index', 'actions', 'description', 'photo', 'type', 'user', 'company'],
          viewTable: ["bordered", 'hover']
        },
        dir: ""
      },
      // viewFilterColumns
      viewColumnsResponsive: {
        default: {
        //   show: "all",// or ['id', 'index']
          show: ['name', 'type', 'photo', 'price', 'product_count', 'count_selling', 'count_rates', 'display', 'actions']
        },
        1200: {
          show: ['name', 'photo', 'price', 'product_count', 'display', 'actions']
        },
        1000: {
          show: ['name', 'photo', 'price', 'actions']
        },
        800: {
          show: ['name', 'photo', 'actions']
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
    getProductsTypes() {
        axios.post(this.urlGetProductsTypes).then(response => {
            if (response.status === 200) {
                this.proTypes = response.data.types
            }
        })
        .catch(errors => {
            setTimeout(() => {
                this.getProductsTypes()
            }, 1000)
        });
    },
    addCompanyIdToRequest() {
        const companyId = this.$route.params.id;
        if (companyId != null) {
            this.tableData.companyId = companyId
        }
        this.viewColumnsResponsive.default.show = ['name', 'type', 'photo', 'price', 'product_count', 'count_rates']
    },

  },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (vm.$route.name == 'products') {
                to.meta.title = vm.$t('sidebar.products')
                vm.setLocaleMessages()
                vm.getProductsTypes()
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
        if (this.$route.name != 'products') {
            this.setLocaleMessages()
            this.getProductsTypes()
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

