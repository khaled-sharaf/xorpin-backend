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
        <header-page title="Company profile"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
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
                                <b>Products Count</b> <a class="float-right">{{ companyProfile.products_count == null ? 0 : companyProfile.products_count }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Users Count</b> <a class="float-right">{{ companyProfile.users_count == null ? 0 : companyProfile.users_count }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Rates</b> <a class="float-right"> <rates-stars :rates-count="companyProfile.count_rates"></rates-stars> </a>
                            </li>
                            </ul>

                            <!-- delete company -->
                            <a
                                :href="$domain_admin + '/company/destroy'"
                                class="btn btn-danger btn-delete-row btn-table-actions btn-sm mr-3 mt-1"
                                @click.prevent="destroyRow(companyProfile.id)"
                            >Delete company
                                <i class="fa fa-trash"></i>
                            </a>

                            <!-- edit company -->
                            <router-link
                                :to="{name: 'edit-company', params: {company: companyProfile, id: companyProfile.id}}"
                                :href="$domain_admin + '/company/' + companyProfile.id + '/edit'"
                                class="btn btn-success btn-edit-row btn-table-actions btn-sm mt-1"
                            >Edit company
                                <i class="fa fa-edit"></i>
                            </router-link>

                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="m-0 card-title">Info company</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- email -->
                            <strong>Email</strong>

                            <p class="text-muted">
                                <a :href="'mailto:' + companyProfile.email">{{companyProfile.email}}</a>
                            </p>

                            <hr>


                            <!-- mobile -->
                            <strong>Mobile</strong>

                            <p class="text-muted">
                                {{companyProfile.phone}}
                            </p>

                            <hr>

                            <!-- Address -->
                            <strong>Address</strong>

                            <p class="text-muted">
                                {{companyProfile.address}}
                            </p>

                            <hr>

                            <!-- Website -->
                            <strong>Website</strong>

                            <p class="text-muted">
                                <a target="_blank" :href="companyProfile.website">{{companyProfile.website}}</a>
                            </p>

                            <hr>

                            <!-- Location -->
                            <strong>Location map</strong>

                            <p class="text-muted">
                                <button
                                    v-if="companyProfile.longitude != null && companyProfile.latitude != null"
                                    class="btn btn-outline-secondary btn-sm"
                                    id="show_map_location"
                                    :data-long="companyProfile.longitude"
                                    :data-lat="companyProfile.latitude"
                                    :data-location-title="companyProfile.name"
                                >Show map</button>
                            </p>

                            <hr>

                            <!-- face link -->
                            <strong>Facabook</strong>

                            <p class="text-muted">
                                <a target="_blank" :href="companyProfile.face_link">{{companyProfile.face_link}}</a>
                            </p>

                            <hr>

                            <!-- tw link -->
                            <strong>Twitter</strong>

                            <p class="text-muted">
                                <a target="_blank" :href="companyProfile.tw_link">{{companyProfile.tw_link}}</a>
                            </p>

                            <hr>

                            <!-- Address -->
                            <strong>Display products</strong>

                            <p class="text-muted">
                                {{companyProfile.display == 1 ? 'Visible' : 'Hidden'}}
                            </p>

                            <hr>

                            <!-- active -->
                            <strong>Activation</strong>

                            <p class="text-muted">
                                {{companyProfile.active == 1 ? 'Active' : 'Disactive'}}
                            </p>

                            <hr>

                            <!-- create at -->
                            <strong>Created at</strong>

                            <p class="text-muted">
                                <relative-date :date="companyProfile.created_at"></relative-date>
                            </p>

                            <hr>


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
                                <li class="nav-item"><a class="nav-link " href="#products" data-toggle="tab">Products</a></li>
                                <li class="nav-item"><a class="nav-link active" href="#users" data-toggle="tab">Users</a></li>

                            </ul>
                            <button class="btn btn-outline-secondary maximize-table float-right" @click="maximizeTable = !maximizeTable"><i class="fas" :class="maximizeTable == true ? 'fa-compress-arrows-alt' : 'fa-compress'"></i></button>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            <div class="tab-pane" id="products">
                               Products
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="users">
                                <users-comp v-if="companyProfile.users_count != null && companyProfile.users_count != 0"></users-comp>

                                <div v-else class="alert alert-info alert-dismissible">
                                    <h5><i class="icon fas fa-info"></i> No users!</h5>
                                    This company does'nt have users.
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
import ModalLocation from './ModalLocation'
import HeaderPage from './../../components/HeaderPage'
export default {
    components: {
        HeaderPage,
        UsersComp,
        ModalLocation
    },
    name: 'company-profile',
    data() {
      return {
          urlCompanyProfile: '/company/profile',
          urlDeleteRow: '/company/destroy',
          maximizeTable: false,
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
            logo: "images/user-avatar/default-avatar.png",
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
                    axios.post(this.urlDeleteRow, {id: id}).then(response => {
                        if (response.status === 200) {
                            Swal.fire("Deleted!", "The company has been deleted.", "success");
                            this.$router.push({name: 'companies'});
                        }
                    }).catch(error => {
                        Swal.fire("Failed!", "The company has not been deleted.", "error");
                        this.$Progress.fail();
                    });
                }
            });
            },
    },

    mounted() {
        this.eventBtnsClick()
    },

    beforeRouteEnter(to, from, next) {
        next(vm => {
                if (to.params.company) {
                    vm.companyProfile = to.params.company
                } else {
                    axios.post(vm.urlCompanyProfile, {id: to.params.id}).then(response => {
                        if (response.status === 200) {
                            const company = response.data.company
                            if (company != null) {
                                vm.companyProfile = company
                            } else {
                                vm.$router.push({name: 'companies'})
                            }
                        }
                    })
                }
        })
    }
}
</script>
