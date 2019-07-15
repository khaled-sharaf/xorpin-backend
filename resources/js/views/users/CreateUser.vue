<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Create user"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'users'}">Show all users</router-link>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="createUser()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-user typeForm="create" :form="form"></form-user>
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
import FormUser from './FormUser'
import HeaderPage from './../../components/HeaderPage'
export default {
    name: 'create-user',
    components: {
        HeaderPage,
        FormUser
    },
    data() {
      return {
        urlCreateUser: '/user/store',
        form: new Form({
          name: "",
          email: "",
          password: "",
          password_confirmation: "",
          phone: "",
          address: "",
          photo: "",
          company_id: "",
          rule: 0,
          active: 1,
        }),
      }
    },
    methods: {
        createUser() {
            loadReq(this.$Progress);
            this.form.post(this.urlCreateUser).then(response => {
                if (response.status === 200) {
                    this.form.reset();
                    ToastReq.fire({
                        text: response.data.message
                    });
                }
            }).catch(response => {
                Swal.fire("Failed!", "The user has not been created.", "error");
                this.$Progress.fail();
            });
        },
    }
}
</script>
