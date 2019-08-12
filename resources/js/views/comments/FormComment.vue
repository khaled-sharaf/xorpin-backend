<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- text comment -->
                <div class="form-group">
                    <label> {{ $t('comments_table.text_comment') }} <span class="field-required"></span></label>
                    <textarea
                        v-model="form.text_comment"
                        type="text"
                        :placeholder="$t('comments_table.text_comment')"
                        class="form-control textarea-form"
                        :class="{ 'is-invalid': form.errors.has('text_comment') }"
                    ></textarea>
                    <has-error :form="form" field="text_comment"></has-error>
                </div>

                <!-- positive_product -->
                <!-- <div class="form-group">
                    <label> {{ $t('comments_table.positive_product') }} <span class="field-required"></span></label>
                    <textarea
                        v-model="form.positive_product"
                        type="text"
                        :placeholder="$t('comments_table.positive_product')"
                        class="form-control textarea-form"
                        :class="{ 'is-invalid': form.errors.has('positive_product') }"
                    ></textarea>
                    <has-error :form="form" field="positive_product"></has-error>
                </div> -->


                <!-- negative_product -->
                <!-- <div class="form-group">
                    <label> {{ $t('comments_table.negative_product') }} <span class="field-required"></span></label>
                    <textarea
                        v-model="form.negative_product"
                        type="text"
                        :placeholder="$t('comments_table.negative_product')"
                        class="form-control textarea-form"
                        :class="{ 'is-invalid': form.errors.has('negative_product') }"
                    ></textarea>
                    <has-error :form="form" field="negative_product"></has-error>
                </div> -->


                <!-- dispaly comment -->
                <div class="form-group">
                    <label> {{ $t('datatable.display') }} <span class="field-required"></span></label>
                    <select
                        v-model="form.display"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('display') }"
                    >
                        <option value="1"> {{ $t('global.visible') }} </option>
                        <option value="0"> {{ $t('global.hidden') }} </option>
                    </select>
                    <has-error :form="form" field="display"></has-error>
                </div>

                <!-- users -->
                <!-- <div class="form-group">
                    <label> {{ $t('comments_table.user_id') }} <span class="field-required"></span></label>
                    <select
                        v-model="form.user_id"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('user_id') }"
                    >
                        <option
                            v-for="user in users"
                            :value="user.id"
                            :key="user.id"
                        >{{ user.id }} ------ {{ user.name }}</option>
                    </select>
                    <has-error :form="form" field="user_id"></has-error>
                </div> -->

                <!-- products -->
                <!-- <div class="form-group">
                    <label> {{ $t('comments_table.product_id') }} <span class="field-required"></span></label>
                    <select
                    v-model="form.product_id"
                    class="custom-select"
                    :class="{ 'is-invalid': form.errors.has('product_id') }"
                    >
                    <option
                        v-for="product in products"
                        :value="product.id"
                        :key="product.id"
                    >{{ product.id }} ------ {{ product.name }}</option>
                    </select>
                    <has-error :form="form" field="product_id"></has-error>
                </div> -->

            </div><!-- ./col-md -->
        </div><!-- ./row -->
    </div>
</template>


<script>
  export default {
    props: ['form', 'typeForm'],
    data() {
      return {
        urlGetAllUsers: '/users-id',
        urlGetAllProducts: '/products-id',
        users: [],
        products: []
      }
    },
    methods: {
        getUsers() {
            axios.post(this.urlGetAllUsers).then(response => {
                let data = response.data;
                if (response.status === 200) {
                    this.users = data;
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getUsers()
                }, 1000)
            });
        },
        getProducts() {
            axios.post(this.urlGetAllProducts).then(response => {
                let data = response.data;
                if (response.status === 200) {
                    this.products = data;
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getProducts()
                }, 1000)
            });
        },
    },
    mounted() {
        this.getUsers()
        this.getProducts()
    },
  }
</script>
