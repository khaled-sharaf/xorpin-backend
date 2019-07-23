<style lang="scss">

</style>

<template>
    <div class="sidebar-layout">
        <aside class="main-sidebar elevation-4" :class="{'sidebar-dark-info': $gate.isAdmin(), 'sidebar-dark-primary': $gate.isAdminCompany()}">
            <!-- Brand Logo -->
            <router-link :to="{name: 'home'}" class="brand-link">
                <img :src="$domain + '/' + $settings.logo" :alt="$settings.site_name + ' logo'" class="brand-image">
                <!-- <span class="brand-text font-weight-light">{{ $settings.site_name }}</span> -->
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img :src="$domain + '/' + $gate.authData().photo" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <router-link class="d-block" :to="{name: 'edit-user', params: {user: $gate.authData(), id: $gate.authData().id}}">{{ $gate.authData().name }}</router-link>
                </div>
            </div>

            <!-- Sidebar Menu-->
             <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" id="nav-sidebar-global" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                    <!-- <li class="nav-item has-treeview menu-open"> -->

                    <!-- =============================== Dashboard ================================== -->
                    <li class="nav-item">
                        <router-link :to="{name: 'home'}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{$t('global.dashboard')}}
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                        </router-link>
                    </li>



                    <!-- =============================== My Company Profile ================================== -->
                    <li class="nav-item" v-if="$gate.isAdminCompany()">
                        <router-link :to="{name: 'company-profile', params: {id: $gate.authCompanyData().id}}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            {{$t('sidebar.company_profile')}}
                        </p>
                        </router-link>
                    </li>


                    <!-- =============================== Users ================================== -->
                    <li class="nav-item has-treeview" v-if="$gate.isAdmin()">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{ $t('sidebar.users') }}
                                <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                                <!-- <span class="badge badge-info right">130</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'users'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_users') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-user'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> {{ $t('global.create') + ' ' + $t('sidebar.new_user') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== Companies ================================== -->
                    <li class="nav-item has-treeview" v-if="$gate.isAdmin()">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            {{ $t('sidebar.companies') }}
                            <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'companies'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_companies') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-company'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> {{ $t('global.create') + ' ' + $t('sidebar.new_company') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== Products ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            {{ $t('sidebar.products') }}
                            <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'products'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_products') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-product'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> {{ $t('global.create') + ' ' + $t('sidebar.new_product') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== Product types ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            {{ $t('sidebar.products_types') }}
                            <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'pro-types'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_products_types') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item" v-if="$gate.isAdmin()">
                                <router-link :to="{name: 'create-pro-type'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> {{ $t('global.create') + ' ' + $t('sidebar.new_products_type') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== winners ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            {{ $t('sidebar.winners') }}
                            <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'winners'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_winners') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item" v-if="$gate.isAdmin()">
                                <router-link :to="{name: 'create-winner'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> {{ $t('global.create') + ' ' + $t('sidebar.new_winner') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== comments ================================== -->
                    <li class="nav-item has-treeview" v-if="$gate.isAdmin()">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            {{ $t('sidebar.comments') }}
                            <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'comments'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_comments') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== settings ================================== -->
                    <li class="nav-item has-treeview" v-if="$gate.isAdmin()">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{ $t('sidebar.settings') }}
                            <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'settings'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_settings') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-setting'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> {{ $t('global.create') + ' ' + $t('sidebar.new_setting') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'setting-carousel'}" class="nav-link">
                                    <i class="fas fa-images nav-icon"></i>
                                    <p> {{ $t('settings_table.carousel') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                </ul>

            </nav>

            <!-- /.sidebar-menu -->

            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>


<script>

export default {
    name: 'sidebar',
    data() {
        return {
        }
    },
    mounted() {

    }
}
</script>
