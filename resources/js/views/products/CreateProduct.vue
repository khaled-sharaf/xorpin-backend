<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Create product"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'products'}">Show all products</router-link>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="createProduct()" class="form-product">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-product typeForm="create" :form="form"></form-product>
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
import FormProduct from './FormProduct'
import HeaderPage from './../../components/HeaderPage'
export default {
    name: 'create-product',
    components: {
        FormProduct,
        HeaderPage
    },
    data() {
      return {
        urlCreateProduct: '/product/store',
        form: new Form({
          name: "",
          price: "",
          discount: "",
          percent: true,
          product_count: "",
          manufacture_company: "",
          description: "",
          display: 1,
          execute: 0,
          type_id: "",
          company_id: "",
          photo: "",
          gallery: [],
          details: [
              {name: '', value: '', display: true}
          ]
        }),
      }
    },
    methods: {
        createProduct() {
            loadReq(this.$Progress);
            this.form.post(this.urlCreateProduct).then(response => {
                if (response.status === 200) {
                    // reset form
                    this.form.reset();
                    ToastReq.fire({
                        text: response.data.message
                    });
                    setTimeout(() => {
                        this.$router.push({name: 'product-profile', params: {id: response.data.data.id, product: response.data.data}})
                        setTimeout(() => {
                            $('html, body, .wrapper, .content-wrapper').scrollTop(0);
                        });
                    }, 2000);
                }
            }).catch(response => {
                Swal.fire("Failed!", "The product has not been created.", "error");
                this.$Progress.fail();
            });
        },
    }
}
</script>
