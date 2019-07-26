<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('sidebar.edit_company')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="m-0 mb-2 text-dark">
                                    <!-- show company profile  -->
                                    <router-link
                                        :to="{name: 'company-profile', params: {company: companyEdit, id: companyEdit.id}}"
                                        :href="$domain_admin + '/company/profile/' + companyEdit.id"
                                        class="btn btn-primary btn-sm"
                                        :class="{ disabled: form.busy }"
                                    >
                                        {{ $t('global.goto_company_profile') }}
                                    </router-link>
                                </h3>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="editCompany()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-company typeForm="edit" :form="form"></form-company>
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
import FormCompany from './FormCompany'
import HeaderPage from './../../components/HeaderPage'
import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    components: {
        HeaderPage,
        FormCompany
    },
    data() {
      return {
        urlEditCompany: '/company/profile',
        urlUpdateCompany: '/company/update',
        form: new Form({
          id: 0,
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
        companyEdit: {},
        idPage: 'companies',
        typePage: 'edit'
      }
    },
    methods: {
        editCompany() {
            this.form.latitude = window.parseFloat($('#company_latitude').val())
            this.form.longitude = window.parseFloat($('#company_longitude').val())
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateCompany).then(response => {
                if (response.status === 200) {
                    this.companyEdit = response.data.data;
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
        getCompanyEdit(route) {
            axios.post(this.urlEditCompany, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    const company = response.data.company
                    if (company != null) {
                        this.companyEdit = company

                        this.form.reset()
                        $('#remove-location-company').click()

                        this.form.fill(this.companyEdit)
                        if (this.form.latitude != null && this.form.longitude != null) {
                            $('.myMap #address').val('')
                        }
                        $('#company_latitude').val(this.form.latitude)
                        $('#company_longitude').val(this.form.longitude)
                    } else {
                        this.$router.push({name: 'companies'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getCompanyEdit(this.$route)
                }, 1000)
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_company')
            if (to.params.id && vm.$gate.isAdminCompany() && to.params.id != vm.$gate.authCompanyData().id) {
                setTimeout(() => {
                    next({name: 'home'})
                }, 100)
            } else {
                if (to.params.company) {
                    vm.companyEdit = to.params.company

                    vm.form.reset()
                    $('#remove-location-company').click()

                    vm.form.fill(vm.companyEdit)
                    if (vm.form.latitude != null && vm.form.longitude != null) {
                        $('.myMap #address').val('')
                    }
                    $('#company_latitude').val(vm.form.latitude)
                    $('#company_longitude').val(vm.form.longitude)
                } else {
                    vm.getCompanyEdit(to)
                }
            }
        })
    }
}
</script>
