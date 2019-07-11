<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-12">
                <div class="btns-route-wrapper">
                    <button @click="$router.go(-1)" type="button" class="back-route btn btn-outline-secondary"><i class="fas fa-arrow-left"></i></button>
                    <button @click="$router.go(1)" type="button" class="back-route btn btn-outline-secondary"><i class="fas fa-arrow-right"></i></button>
                </div>
                <h2 class="m-0 my-4 text-dark title-page">{{title}}</h2>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
</template>


<script>
    export default {
        props: {
            title: String
        }
    }
</script>
