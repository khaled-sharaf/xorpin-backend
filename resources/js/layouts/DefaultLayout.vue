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
            <router-view/>
            <!-- /.content -->

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
