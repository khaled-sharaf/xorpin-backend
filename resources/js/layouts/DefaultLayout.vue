<style lang="scss">

</style>

<template>
    <div>

        <!-- Navbar -->
        <navbar></navbar>
        <!-- /.navbar -->

        <!-- Sidebar -->
        <sidebar></sidebar>
        <!-- /.Sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <!-- :exclude="['company-profile']" -->
            <!-- :include="['create-user', 'create-company']" -->
            <keep-alive :include="['create-user', 'create-company']">
                <router-view/>
            </keep-alive>
            <!-- /.content -->
            <vue-progress-bar/>

        </div>
        <!-- /.content-wrapper -->

    </div>
</template>


<script>

import Navbar from './../components/Navbar'
import Sidebar from './../components/Sidebar'
export default {
    components: {
        Navbar,
        Sidebar
    },
    data() {
        return {

        }
    },
    mounted() {

    }
}
</script>
