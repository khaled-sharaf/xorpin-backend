<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Edit product"></header-page>
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
                                        :to="{name: 'product-profile', params: {product: productEdit, id: productEdit.id}}"
                                        :href="$domain_admin + '/product/profile/' + productEdit.id"
                                        class="btn btn-primary btn-sm"
                                        :class="{ disabled: form.busy }"
                                    >
                                        Go to profile
                                    </router-link>
                                </h3>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="editProduct()" class="form-product">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-product typeForm="edit" :form="form"></form-product>
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
import FormProduct from './FormProduct'
import HeaderPage from './../../components/HeaderPage'
export default {
    components: {
        HeaderPage,
        FormProduct
    },
    data() {
      return {
        urlEditProduct: '/product/profile',
        urlUpdateProduct: '/product/update',
        form: new Form({
          id: 0,
          name: "",
          price: "",
          discount: "",
          percent: 1,
          product_count: "",
          manufacture_company: "",
          description: "",
          display: 1,
          execute: 0,
          type_id: "",
          company_id: "",
          photo: "",
          gallery: [],
          deletedGallery: [],
          details: [
              {name: '', value: '', display: true}
          ],
          deletedDetails: [],
        }),
        productEdit: {}
      }
    },
    methods: {
        editProduct() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateProduct).then(response => {
                if (response.status === 200) {
                    let product = response.data.data
                    if (product.gallery !== null && product.gallery != '') {
                        let gallery = product.gallery.split(',')
                        let galleryArr = []
                        gallery.forEach(image => {
                            galleryArr.push({id:  Math.floor(Math.random() * 10000), url: image})
                        })
                        product.gallery = galleryArr
                    } else {
                        product.gallery = []
                    }
                    if (!product.details.length) {
                        product.details.push({name: '', value: '', display: true})
                    }
                    this.productEdit = product
                    this.productEdit.deletedGallery = []
                    this.productEdit.deletedDetails = []
                    this.form.reset()
                    this.form.fill(this.productEdit)
                    ToastReq.fire({
                        text: response.data.message
                    });
                }
            }).catch(response => {
                Swal.fire("Failed!", "The product has not been updated.", "error");
                this.$Progress.fail();
            });
        },
        getProductEdit(route) {
            axios.post(this.urlEditProduct, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    const product = response.data.product
                    if (product != null) {
                        if (product.gallery !== null && product.gallery != '') {
                            let gallery = product.gallery.split(',')
                            let galleryArr = []
                            gallery.forEach(image => {
                                galleryArr.push({id:  Math.floor(Math.random() * 10000), url: image})
                            })
                            product.gallery = galleryArr
                        } else {
                            product.gallery = []
                        }
                        if (!product.details.length) {
                            product.details.push({name: '', value: '', display: true})
                        }
                        this.productEdit = product
                        this.productEdit.deletedGallery = []
                        this.productEdit.deletedDetails = []
                        this.form.reset()
                        this.form.fill(this.productEdit)
                    } else {
                        this.$router.push({name: 'products'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getProductEdit(this.$route)
                }, 1000)
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (to.params.product) {
                let product = to.params.product
                if (typeof product.gallery != 'object') {
                    if (product.gallery !== null && product.gallery != '') {
                        let gallery = product.gallery.split(',')
                        let galleryArr = []
                        gallery.forEach(image => {
                            galleryArr.push({id:  Math.floor(Math.random() * 10000), url: image})
                        })
                        product.gallery = galleryArr
                    } else {
                        product.gallery = []
                    }
                }
                if (!product.details.length) {
                    product.details.push({name: '', value: '', display: true})
                }
                vm.productEdit = product
                vm.productEdit.deletedGallery = []
                vm.productEdit.deletedDetails = []
                vm.form.reset()
                vm.form.fill(vm.productEdit)
            } else {
                vm.getProductEdit(to)
            }
        })
    }
}
</script>
