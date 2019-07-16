<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

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
