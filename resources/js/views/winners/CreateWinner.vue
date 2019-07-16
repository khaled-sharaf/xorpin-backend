<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Create products type"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'winners'}">Show all winners</router-link>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="createWinner()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-winner typeForm="create" :form="form"></form-winner>
                                </div>
                                <!-- ./card-body -->


                                <!-- card-footer -->
                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        :disabled="form.busy"
                                        class="btn btn-primary float-right"
                                    >Create</button>
                                </div> <!-- ./card-footer -->

                            </form><!-- form -->
                        </div>
                    </div><!-- /.col-12 -->

                </div><!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
import FormWinner from './FormWinner'
import HeaderPage from './../../components/HeaderPage'
export default {
    name: 'create-pro-type',
    components: {
        FormWinner,
        HeaderPage
    },
    data() {
      return {
        urlCreateWinner: '/winner/store',
        form: new Form({
          name: "",
          display: 1
        }),
      }
    },
    methods: {
        createWinner() {
            loadReq(this.$Progress);
            this.form.post(this.urlCreateWinner).then(response => {
                if (response.status === 200) {
                    // reset form
                    this.form.reset();
                    ToastReq.fire({
                        text: response.data.message
                    });
                }
            }).catch(response => {
                Swal.fire("Failed!", "The winner has not been created.", "error");
                this.$Progress.fail();
            });
        },
    }
}
</script>
