<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('global.edit') + ' ' + ($auth.id == $route.params.id ? $t('global.the_profile') : $t('global.user'))"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="m-0 mb-2 text-dark">{{ $t('global.user') | capitalize }} <span style="color: #3498db"> {{ userEdit.name }}</span></h3>
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
                                    > {{ $t('global.update') }} </button>
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

import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
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
        userEdit: {},
        idPage: 'users',
        typePage: 'edit'
      }
    },
    methods: {
        editUser() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateUser).then(response => {
                if (response.status === 200) {
                    ToastReq.fire({
                        text: this.success_msg
                    });
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail();
            });
        },
        getUserEdit(route) {
            axios.post(this.urlEditUser, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    const user = response.data.user
                    if (user != null) {
                        this.userEdit = user
                        this.form.reset()
                        this.form.fill(this.userEdit)
                    } else {
                        this.$router.push({name: 'users'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getUserEdit(this.$route)
                }, 1000)
            })
        }
    },
    watch: {
        "$route.params.id"(val) {
            if (this.$route.params.user) {
                this.userEdit = this.$route.params.user
                this.form.reset()
                this.form.fill(this.userEdit)
            } else {
                this.getUserEdit(this.$route)
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_user')
            if (to.params.id && vm.$gate.isAdminCompany() && to.params.id != vm.$auth.id) {
                setTimeout(() => {
                    next({name: 'home'})
                }, 100)
            } else {
                if (to.params.user) {
                    vm.userEdit = to.params.user
                    vm.form.reset()
                    vm.form.fill(vm.userEdit)
                } else {
                    vm.getUserEdit(to)
                }
            }
        })
    }
}
</script>
