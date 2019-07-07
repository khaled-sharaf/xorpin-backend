<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Edit user {{ $route.params.id }}</h1>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">

                    <form-user type="edit"></form-user>

                </div><!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
import FormUser from './FormUser'
export default {
    components: {
        FormUser
    },
    mounted() {
        document.title = 'Edit user ' + $route.params.id
    }
}
</script>
