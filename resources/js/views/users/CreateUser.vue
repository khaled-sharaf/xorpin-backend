<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title=" $t('global.create') + ' ' + $t('sidebar.new_user') "></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'users'}">{{ $t('global.show') + ' ' + $t('sidebar.all_users') }}</router-link>
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
                                    > {{ $t('global.create') }} </button>
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
          address: 1,
          photo: "",
          company_id: "",
          rule: 0,
          active: 1,
        }),
        idPage: 'users',
        typePage: 'create'
      }
    },
    methods: {
        createUser() {
            loadReq(this.$Progress);
            this.form.post(this.urlCreateUser).then(response => {
                if (response.status === 200) {
                    this.form.reset();
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
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_user')
        })
    }
}
</script>
