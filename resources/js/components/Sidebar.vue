<style lang="scss">

</style>

<template>
    <div class="sidebar-layout">
        <aside class="main-sidebar sidebar-dark-info elevation-4">
            <!-- Brand Logo -->
            <router-link :to="{name: 'home'}" class="brand-link">
                <img :src="$domain + '/adminlte/dist/img/AdminLTELogo.png'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">CP - xorpin</span>
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img :src="$domain + '/' + $gate.authData().photo" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block">{{ $gate.authData().name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu-->
             <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" id="nav-sidebar-global" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                    <!-- <li class="nav-item has-treeview menu-open"> -->

                    <li class="nav-item">
                        <router-link :to="{name: 'home'}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                        </router-link>
                    </li>

                    <!-- <li class="nav-item">
                        <router-link :to="{name: 'home-test'}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard Test
                        </p>
                        </router-link>
                    </li> -->


                    <!-- =============================== Users ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">130</span> -->
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'users'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p>Show all users</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-user'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Create new user</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== Companies ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Companies
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'companies'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p>Show all companies</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-company'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Create new company</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== Products ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'products'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p>Show all products</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-product'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Create new product</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                     <!-- =============================== Product types ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Products types
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'pro-types'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p>Show all products types</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-pro-type'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Create new products type</p>
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
