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
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'settings'}">Show all settings</router-link>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="createSetting()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-setting typeForm="create" :form="form"></form-setting>
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
import FormSetting from './FormSetting'
import HeaderPage from './../../components/HeaderPage'
export default {
    name: 'create-setting',
    components: {
        FormSetting,
        HeaderPage
    },
    data() {
      return {
        urlCreateSetting: '/setting/store',
        form: new Form({
          slug: "",
          name: "",
          value: "",
          type: "string",
        }),
      }
    },
    methods: {
        createSetting() {
            loadReq(this.$Progress);
            this.form.post(this.urlCreateSetting).then(response => {
                if (response.status === 200) {
                    console.log(response.data)
                    // reset form
                    this.form.reset();
                    ToastReq.fire({
                        text: response.data.message
                    });
                }
            }).catch(response => {
                Swal.fire("Failed!", "The setting has not been created.", "error");
                this.$Progress.fail();
            });
        },
    }
}
</script>
