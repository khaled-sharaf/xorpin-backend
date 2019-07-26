<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title=" $t('global.create') + ' ' + $t('sidebar.new_company') "></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'companies'}">{{ $t('global.show') + ' ' + $t('sidebar.all_companies') }}</router-link>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="createCompany()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-company typeForm="create" :form="form"></form-company>
                                </div>
                                <!-- ./card-body -->


                                <!-- card-footer -->
                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        :disabled="form.busy"
                                        class="btn btn-primary float-right"
                                    >{{ $t('global.create') }}</button>
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
import FormCompany from './FormCompany'
import HeaderPage from './../../components/HeaderPage'
import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    name: 'create-company',
    components: {
        FormCompany,
        HeaderPage
    },
    data() {
      return {
        urlCreateCompany: '/company/store',
        form: new Form({
          name: "",
          logo: "",
          email: "",
          phone: "",
          address: "",
          website: "",
          description: "",
          latitude: "",
          longitude: "",
          face_link: "",
          tw_link: "",
          display: 1,
          active: 1,
        }),
        idPage: 'companies',
        typePage: 'create'
      }
    },
    methods: {
        createCompany() {
            this.form.latitude = window.parseFloat($('#company_latitude').val())
            this.form.longitude = window.parseFloat($('#company_longitude').val())
            loadReq(this.$Progress);
            this.form.post(this.urlCreateCompany).then(response => {
                if (response.status === 200) {
                    // reset form
                    this.form.reset();
                    $('#remove-location-company').click()
                    ToastReq.fire({
                        text: this.success_msg
                    });
                    setTimeout(() => {
                        this.$router.push({name: 'company-profile', params: {id: response.data.data.id, company: response.data.data}})
                        setTimeout(() => {
                            $('html, body, .wrapper, .content-wrapper').scrollTop(0);
                        });
                    }, 2000);
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
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_company')
        })
    }
}
</script>
