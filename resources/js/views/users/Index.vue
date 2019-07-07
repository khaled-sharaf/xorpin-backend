<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">User Index</h1>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">

                    <router-link :to="{name: 'create-user'}">Create User</router-link>
                    <router-link :to="{name: 'edit-user', params: {id: '1'}}">Edit User 1</router-link>

                </div><!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
    export default {
        mounted() {
            document.title = 'Dashboard Test'
        }
    }
</script>
