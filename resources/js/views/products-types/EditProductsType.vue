<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('sidebar.edit_products_type')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="m-0 mb-2 text-dark">
                                    <h3 class="m-0 mb-2 text-dark">{{ $t('global.products_type') | capitalize }}: <span style="color: #3498db"> {{ proTypeEdit.name }}</span></h3>
                                </h3>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="editProductType()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-products-type typeForm="edit" :form="form"></form-products-type>
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
import FormProductsType from './FormProductsType'
import HeaderPage from './../../components/HeaderPage'
import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    components: {
        HeaderPage,
        FormProductsType
    },
    data() {
      return {
        urlEditProType: '/pro-type/edit',
        urlUpdateProType: '/pro-type/update',
        form: new Form({
          id: 0,
          name: "",
          display: 1,
        }),
        proTypeEdit: {},
        idPage: 'products_types',
        typePage: 'edit'
      }
    },
    methods: {
        editProductType() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateProType).then(response => {
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
        getProductsTypeEdit(route) {
            axios.post(this.urlEditProType, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    const proType = response.data.proType
                    if (proType != null) {
                        this.proTypeEdit = proType

                        this.form.reset()
                        this.form.fill(this.proTypeEdit)
                    } else {
                        this.$router.push({name: 'pro-types'})
                    }
                }
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_products_type')
            if (to.params.proType) {
                vm.proTypeEdit = to.params.proType
                vm.form.reset()
                vm.form.fill(vm.proTypeEdit)
            } else {
                vm.getProductsTypeEdit(to)
            }
        })
    }
}
</script>
