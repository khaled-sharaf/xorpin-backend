<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Create company"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'companies'}">Show all companies</router-link>
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
import FormCompany from './FormCompany'
import HeaderPage from './../../components/HeaderPage'
export default {
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
                        text: response.data.message
                    });
                    setTimeout(() => {
                        this.$router.push({name: 'company-profile', params: {id: response.data.data.id, company: response.data.data}})
                        setTimeout(() => {
                            $('html, body, .wrapper, .content-wrapper').scrollTop(0);
                        });
                    }, 2000);
                }
            }).catch(response => {
                Swal.fire("Failed!", "The company has not been created.", "error");
                this.$Progress.fail();
            });
        },
    }
}
</script>
