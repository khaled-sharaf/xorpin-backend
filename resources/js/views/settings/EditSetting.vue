<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('sidebar.edit_setting')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="m-0 mb-2 text-dark">
                                    <h3 class="m-0 mb-2 text-dark">{{ $t('global.setting') | capitalize }}: <span style="color: #3498db"> {{ settingEdit.slug }}</span></h3>
                                </h3>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="editSetting()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-setting typeForm="edit" :form="form"></form-setting>
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
import FormSetting from './FormSetting'
import HeaderPage from './../../components/HeaderPage'
import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    components: {
        HeaderPage,
        FormSetting
    },
    data() {
      return {
        urlEditSetting: '/setting/edit',
        urlUpdateSetting: '/setting/update',
        form: new Form({
          id: 0,
          slug: "",
          name: "",
          value: "",
          type: "string"
        }),
        settingEdit: {},
        idPage: 'settings',
        typePage: 'edit'
      }
    },
    methods: {
        editSetting() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateSetting).then(response => {
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
        getSettingEdit(route) {
            axios.post(this.urlEditSetting, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    const setting = response.data.setting
                    if (setting != null) {
                        this.settingEdit = setting
                        this.form.reset()
                        this.form.fill(this.settingEdit)
                    } else {
                        this.$router.push({name: 'settings'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getSettingEdit(this.$route)
                }, 1000)
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_setting')
            if (to.params.setting) {
                vm.settingEdit = to.params.setting
                vm.form.reset()
                vm.form.fill(vm.settingEdit)
            } else {
                vm.getSettingEdit(to)
            }
        })
    }
}
</script>
