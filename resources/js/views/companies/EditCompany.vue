<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Edit company"></header-page>
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
                                        class="btn btn-primary"
                                        :class="{ disabled: form.busy }"
                                    >
                                        Go to profile
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
import FormCompany from './FormCompany'
import HeaderPage from './../../components/HeaderPage'
export default {
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
        companyEdit: {}
      }
    },
    methods: {
        editCompany() {
            this.form.latitude = window.parseFloat($('#company_latitude').val())
            this.form.longitude = window.parseFloat($('#company_longitude').val())
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateCompany).then(response => {
                console.log();
                if (response.status === 200) {
                    this.companyEdit = response.data.data;
                    setTimeout(() => {
                        Toast.fire({
                            type: "success",
                            title: response.data.message
                        });
                    }, 700);
                }
            }).catch(response => {
                Swal.fire("Failed!", "The company has not been created.", "error");
                this.$Progress.fail();
            });
        },
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
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
                axios.post(vm.urlEditCompany, {id: to.params.id}).then(response => {
                    if (response.status === 200) {
                        const company = response.data.company
                        if (company != null) {
                            vm.companyEdit = company

                            vm.form.reset()
                            $('#remove-location-company').click()

                            vm.form.fill(vm.companyEdit)
                            if (vm.form.latitude != null && vm.form.longitude != null) {
                                $('.myMap #address').val('')
                            }
                            $('#company_latitude').val(vm.form.latitude)
                            $('#company_longitude').val(vm.form.longitude)
                        } else {
                            vm.$router.push({name: 'companies'})
                        }
                    }
                })
            }
        })
    }
}
</script>
