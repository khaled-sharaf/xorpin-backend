<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Edit user"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="m-0 mb-2 text-dark">User: <span style="color: #3498db"> {{ userEdit.name }}</span></h3>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="editUser()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-user typeForm="edit" :form="form"></form-user>
                                </div>
                                <!-- ./card-body -->


                                <!-- card-footer -->
                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        :disabled="form.busy"
                                        class="btn btn-success float-right"
                                    >Update</button>
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
    components: {
        HeaderPage,
        FormUser
    },
    data() {
      return {
        urlEditUser: '/user/edit',
        urlUpdateUser: '/user/update',
        form: new Form({
          id: "",
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
        userEdit: {}
      }
    },
    methods: {
        editUser() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateUser).then(response => {
                if (response.status === 200) {
                    ToastReq.fire({
                        text: response.data.message
                    });
                }
            }).catch(response => {
                Swal.fire("Failed!", "The user has not been created.", "error");
                this.$Progress.fail();
            });
        },
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (to.params.user) {
                vm.userEdit = to.params.user
                vm.form.reset()
                vm.form.fill(vm.userEdit)
            } else {
                axios.post(vm.urlEditUser, {id: to.params.id}).then(response => {
                    if (response.status === 200) {
                        const user = response.data.user
                        if (user != null) {
                            vm.userEdit = user
                            vm.form.reset()
                            vm.form.fill(vm.userEdit)
                        } else {
                            vm.$router.push({name: 'users'})
                        }
                    }
                })
            }
        })
    }
}
</script>
