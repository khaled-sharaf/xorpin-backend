<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('global.show') + ' ' + $t('sidebar.all_companies')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="dataTable" id="companies">
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

                                            <activation
                                                @getData="getData"
                                                :tableData="tableData"
                                            ></activation>

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
                                                <router-link :to="{name: 'create-company'}" tag="button"
                                                    type="button"
                                                    class="btn btn-outline-secondary"
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

            <!-- modal location company -->

            <modal-location></modal-location>

            <!-- ./modal location company -->
        </section>
    </div>
</template>


<script>
import Trashed from "./../../components/dataTables/filters/Trashed";
import Activation from "./../../components/dataTables/filters/Activation";
import Display from "./../../components/dataTables/filters/Display";
import CreatedBetween from "./../../components/dataTables/filters/CreatedBetween";
import Search from "./../../components/dataTables/filters/Search";
import TableContent from "./TableContent";
import ModalLocation from "./ModalLocation"

import MixinsDatatable from "./../../mixins/MixinsDatatable"

export default {
    mixins: [MixinsDatatable],
        components: {
        Trashed,
        Activation,
        Display,
        CreatedBetween,
        Search,
        TableContent,
        ModalLocation
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
      { label: "Visits", name: "visits" },
      { label: "Location", name: "location" },
      { label: "Facebook", name: "face_link" },
      { label: "Twitter", name: "tw_link" },
      { label: "Display", name: "display" },
      { label: "Active", name: "active" },
      { label: "Created at", name: "created_at" },
      { label: "Actions", name: "actions" }
    ];
    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      idPage: 'companies',
      urlGetDataTable: '/companies',
      urlDeleteRow: '/company/destroy',
      urlRestoreRow: '/company/restore',

      columns: columns,
      sortOrders: sortOrders,

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
            "visits",
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
          show: ['name', 'phone', 'address', 'logo', 'count_rates', 'actions']
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
    };
  },
  methods: {
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
    eventBtnsClickLocale() {
      let self = this;
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
  },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.companies')
            vm.setLocaleMessages()
            vm.sortOrders[vm.sortKey] = 1; // 1 = desc , -1 = asc
            vm.sortBy(vm.sortKey);
            vm.eventBtnsClick();
            vm.eventBtnsClickLocale();
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
