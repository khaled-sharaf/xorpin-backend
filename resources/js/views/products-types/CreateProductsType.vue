<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('global.create') + ' ' + $t('sidebar.new_products_type')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'pro-types'}">{{ $t('global.show') + ' ' + $t('sidebar.all_products_types') }}</router-link>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="createProductType()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-products-type typeForm="create" :form="form"></form-products-type>
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
import FormProductsType from './FormProductsType'
import HeaderPage from './../../components/HeaderPage'
import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    name: 'create-pro-type',
    components: {
        FormProductsType,
        HeaderPage
    },
    data() {
      return {
        urlCreateProType: '/pro-type/store',
        form: new Form({
          name: "",
          display: 1
        }),
        idPage: 'products_types',
        typePage: 'create'
      }
    },
    methods: {
        createProductType() {
            loadReq(this.$Progress);
            this.form.post(this.urlCreateProType).then(response => {
                if (response.status === 200) {
                    // reset form
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
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_products_type')
        })
    }
}
</script>
