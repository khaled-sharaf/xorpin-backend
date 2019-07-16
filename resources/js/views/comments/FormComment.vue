<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- text comment -->
                <div class="form-group">
                    <label>Comment content <span class="field-required"></span></label>
                    <textarea
                        v-model="form.text_comment"
                        type="text"
                        placeholder="Comment"
                        class="form-control textarea-form"
                        :class="{ 'is-invalid': form.errors.has('text_comment') }"
                    ></textarea>
                    <has-error :form="form" field="text_comment"></has-error>
                </div>

                <!-- positive_product -->
                <div class="form-group">
                    <label>Positive product <span class="field-required"></span></label>
                    <textarea
                        v-model="form.positive_product"
                        type="text"
                        placeholder="Positive product"
                        class="form-control textarea-form"
                        :class="{ 'is-invalid': form.errors.has('positive_product') }"
                    ></textarea>
                    <has-error :form="form" field="positive_product"></has-error>
                </div>


                <!-- negative_product -->
                <div class="form-group">
                    <label>Negative product <span class="field-required"></span></label>
                    <textarea
                        v-model="form.negative_product"
                        type="text"
                        placeholder="Negative product"
                        class="form-control textarea-form"
                        :class="{ 'is-invalid': form.errors.has('negative_product') }"
                    ></textarea>
                    <has-error :form="form" field="negative_product"></has-error>
                </div>


                <!-- dispaly comment -->
                <div class="form-group">
                    <label>Display comment <span class="field-required"></span></label>
                    <select
                    v-model="form.display"
                    class="custom-select"
                    :class="{ 'is-invalid': form.errors.has('display') }"
                    >
                    <option
                        v-for="(display, i) in displayArr"
                        :value="display.value"
                        :key="i"
                    >{{ display.text }}</option>
                    </select>
                    <has-error :form="form" field="display"></has-error>
                </div>

                <!-- users -->
                <div class="form-group">
                    <label>User <span class="field-required"></span></label>
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
                </div>

                <!-- products -->
                <div class="form-group">
                    <label>Product <span class="field-required"></span></label>
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
                </div>

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
        products: [],
        displayArr: [
          { text: "Visible comment", value: 1 },
          { text: "Hidden comment", value: 0 }
        ],
      }
    },
    methods: {
        getUsers(url = this.urlGetAllUsers) {
            axios.post(url).then(response => {
                let data = response.data;
                if (response.status === 200) {
                    this.users = data;
                }
            });
        },
        getProducts(url = this.urlGetAllProducts) {
            axios.post(url).then(response => {
                let data = response.data;
                if (response.status === 200) {
                    this.products = data;
                }
            });
        },
    },
    mounted() {
        this.getUsers()
        this.getProducts()
    },
  }
</script>
