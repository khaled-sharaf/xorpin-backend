<style lang="scss">

    .col-table-maximize {
        order: 1;
        margin-bottom: 50px;
    }
    .col-sidebar {
        order: 2;
    }

</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('sidebar.company_profile')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid company-profile-wrapper">
                <div class="row mt-3">
                    <div :class="maximizeTable == true ? 'col-sidebar col-12' : 'col-md-12 col-xl-4'">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                :src="$domain + '/' + companyProfile.logo"
                                alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ companyProfile.name }}</h3>

                            <p class="text-muted text-center">{{ companyProfile.description }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b> {{ $t('companies_table.products_count') }} </b> <a class="float-right">{{ companyProfile.products_count == null ? 0 : companyProfile.products_count }}</a>
                            </li>
                            <li class="list-group-item">
                                <b> {{ $t('companies_table.users_count') }} </b> <a class="float-right">{{ companyProfile.users_count == null ? 0 : companyProfile.users_count }}</a>
                            </li>
                            <li class="list-group-item">
                                <b> {{ $t('companies_table.count_rates') }} </b> <a class="float-right"> <rates-stars :rates-count="companyProfile.count_rates"></rates-stars> </a>
                            </li>
                            </ul>

                            <!-- delete company -->
                            <a
                                v-if="$gate.isAdmin()"
                                :href="$domain_admin + '/company/destroy'"
                                class="btn btn-danger btn-delete-row btn-table-actions btn-sm mr-3 mt-1"
                                @click.prevent="destroyRow(companyProfile.id)"
                            > {{ $t('companies_table.delete_company') }}
                                <i class="fa fa-trash"></i>
                            </a>

                            <!-- edit company -->
                            <router-link
                                :to="{name: 'edit-company', params: {company: companyProfile, id: companyProfile.id}}"
                                :href="$domain_admin + '/company/' + companyProfile.id + '/edit'"
                                class="btn btn-success btn-edit-row btn-table-actions btn-sm mt-1"
                            > {{ $t('companies_table.edit_company') }}
                                <i class="fa fa-edit"></i>
                            </router-link>

                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="m-0 card-title"> {{ $t('companies_table.company_info') }} </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- email -->
                            <strong> {{ $t('companies_table.email') }} </strong>

                            <p class="text-muted">
                                <a :href="'mailto:' + companyProfile.email">{{companyProfile.email}}</a>
                            </p>

                            <hr>


                            <!-- mobile -->
                            <strong> {{ $t('companies_table.phone') }} </strong>

                            <p class="text-muted">
                                {{companyProfile.phone}}
                            </p>

                            <hr>

                            <!-- Address -->
                            <strong> {{ $t('companies_table.address') }} </strong>

                            <p class="text-muted">
                                {{companyProfile.address}}
                            </p>

                            <hr>

                            <!-- Website -->
                            <strong> {{ $t('companies_table.website') }} </strong>

                            <p class="text-muted">
                                <a target="_blank" :href="companyProfile.website">{{companyProfile.website}}</a>
                            </p>

                            <hr>

                            <!-- Location -->
                            <strong> {{ $t('companies_table.location_map') }} </strong>

                            <p class="text-muted">
                                <button
                                    v-if="companyProfile.longitude != null && companyProfile.latitude != null"
                                    class="btn btn-outline-secondary btn-sm"
                                    id="show_map_location"
                                    :data-long="companyProfile.longitude"
                                    :data-lat="companyProfile.latitude"
                                    :data-location-title="companyProfile.name"
                                > {{ $t('companies_table.show_map') }} </button>
                            </p>

                            <hr>

                            <!-- face link -->
                            <strong> {{ $t('companies_table.face_link') }} </strong>

                            <p class="text-muted">
                                <a target="_blank" :href="companyProfile.face_link">{{companyProfile.face_link}}</a>
                            </p>

                            <hr>

                            <!-- tw link -->
                            <strong> {{ $t('companies_table.tw_link') }} </strong>

                            <p class="text-muted">
                                <a target="_blank" :href="companyProfile.tw_link">{{companyProfile.tw_link}}</a>
                            </p>

                            <hr>

                            <!-- Address -->
                            <strong> {{ $t('datatable.display') }} </strong>

                            <p class="text-muted">
                                {{companyProfile.display == 1 ? $t('global.visible') : $t('global.hidden')}}
                            </p>

                            <hr>

                            <!-- active -->
                            <div v-if="$gate.isAdmin()">

                                <strong> {{ $t('datatable.activation') }} </strong>

                                <p class="text-muted">
                                    {{companyProfile.active == 1 ? $t('global.active') : $t('global.disactive')}}
                                </p>

                                <hr>
                            </div>

                            <!-- create at -->
                            <strong> {{ $t('companies_table.created_at') }} </strong>

                            <p class="text-muted">
                                <relative-date :date="companyProfile.created_at"></relative-date>
                            </p>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div :class="maximizeTable == true ? 'col-table-maximize col-12' : 'col-md-12 col-xl-8'">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" style="display: inline-flex;">
                                <li class="nav-item" v-if="$gate.isAdmin()"><a @click="showUserTable = false" class="nav-link active" href="#products" data-toggle="tab"> {{ $t('sidebar.products') }} </a></li>
                                <li class="nav-item"><a @click="showUserTable = true" class="nav-link" :class="{active: $gate.isAdminCompany()}" href="#users" data-toggle="tab"> {{ $t('sidebar.users') }} </a></li>

                            </ul>
                            <button class="btn btn-outline-secondary maximize-table" @click="maximizeTable = !maximizeTable"><i class="fas" :class="maximizeTable == true ? 'fa-compress-arrows-alt' : 'fa-compress'"></i></button>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            <div class="tab-pane active" id="products" v-if="$gate.isAdmin()">
                               <products v-if="(companyProfile.products_count != null && companyProfile.products_count != 0) && showUserTable === false"></products>

                                <div v-else class="alert alert-info alert-dismissible">
                                    <h5><i class="icon fas fa-info"></i>  {{ $t('global.no_products') }} !</h5>
                                     {{ $t('companies_table.empty_products_msg') }}
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" :class="{active: $gate.isAdminCompany()}" id="users">
                                <users-comp v-if="(companyProfile.users_count != null && companyProfile.users_count != 0) && showUserTable === true"></users-comp>

                                <div v-else class="alert alert-info alert-dismissible">
                                    <h5><i class="icon fas fa-info"></i>  {{ $t('global.no_users') }} !</h5>
                                    {{ $t('companies_table.empty_users_msg') }}
                                </div>

                            </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>

        <modal-location></modal-location>
    </div>
</template>


<script>

import UsersComp from './../users/Index'
import products from './../products/Index'
import ModalLocation from './ModalLocation'
import HeaderPage from './../../components/HeaderPage'
import MixinChangeLocaleMessagesProfiles from "./../../mixins/MixinChangeLocaleMessagesProfiles"
import mixinDeleteRow from "./../../mixins/mixinDeleteRow"

export default {
    mixins: [
        MixinChangeLocaleMessagesProfiles,
        mixinDeleteRow
    ],
    components: {
        HeaderPage,
        UsersComp,
        products,
        ModalLocation
    },
    name: 'company-profile',
    data() {
      return {
          urlCompanyProfile: '/company/profile',
          urlDeleteRow: '/company/destroy',
          idPage: 'companies',
          maximizeTable: false,
          showUserTable: false,
          companyProfile: {
            id: 0,
            name: "",
            active: 1,
            address: "",
            count_rates: 0,
            created_at: "",
            description: "",
            display: 1,
            email: "",
            face_link: "",
            latitude: "",
            longitude: "",
            logo: "images/companies-logo/company-default-avatar.jpg",
            phone: "",
            products_count: 0,
            tw_link: "",
            updated_at: null,
            user_id: 1,
            users_count: 0,
            website: "",
          }
      }
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
        eventBtnsClick() {
            let self = this;
            let oldText = $('#locationTitle').text()
        // show location in google map
            $(document).on("click", "#show_map_location", function(e) {
                e.preventDefault();
                let lat = $(this).attr('data-lat'),
                    long = $(this).attr('data-long'),
                    title = $(this).attr('data-location-title');
                if ( (typeof lat != 'undefined' && lat != '' && lat != null) &&
                    (typeof long != 'undefined' && long != '' && long != null) ) {
                    $('#locationTitle').html(oldText + ' ' + `<span style="color: #3498db">${title}</span>`);
                    $('#myScriptMap').remove();
                    self.showMap(lat, long);
                    $('#modal_location_company').modal('show');
                }
            });
        },
        getCompanyProfile(route) {
            axios.post(this.urlCompanyProfile, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    const company = response.data.company
                    if (company != null) {
                        this.companyProfile = company
                    } else {
                        this.$router.push({name: 'companies'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getCompanyProfile(this.$route)
                }, 1000)
            })
        }
    },

    mounted() {
        this.eventBtnsClick()
        if (this.$gate.isAdminCompany()) {
            this.showUserTable = true
        }
    },

    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.company_profile')
            if (to.params.id && vm.$gate.isAdminCompany() && to.params.id != vm.$gate.authCompanyData().id) {
                setTimeout(() => {
                    next({name: 'home'})
                }, 100)
            } else {
                if (to.params.company) {
                    vm.companyProfile = to.params.company
                } else {
                    vm.getCompanyProfile(to)
                }
            }
        })
    }
}
</script>
