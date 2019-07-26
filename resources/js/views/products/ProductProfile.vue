<style lang="scss">

    .col-table-maximize {
        order: 1;
        margin-bottom: 50px;
    }
    .col-sidebar {
        order: 2;
    }

</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('sidebar.product_profile')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid proudct-profile-wrapper">
                <div class="row mt-3">
                    <div :class="maximizeTable == true ? 'col-sidebar col-12' : 'col-md-12 col-xl-4'">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img product-image"
                                :src="$domain + '/' + productProfile.photo"
                                alt="Product profile picture">
                            </div>


                            <h3 class="profile-username">{{ productProfile.name }}</h3>
                            <hr>
                            <div class="actions-product-profile">
                                <!-- delete product -->
                                <a
                                    :href="$domain_admin + '/product/destroy'"
                                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm mr-1 mt-1"
                                    @click.prevent="destroyRow(productProfile.id)"
                                > {{ $t('products_table.delete_product') }}
                                    <i class="fa fa-trash"></i>
                                </a>


                                <!-- sell product -->
                                <a
                                    :href="$domain_admin + '/product/sell'"
                                    class="btn btn-secondary btn-sell-product btn-table-actions btn-sm mr-1 mt-1"
                                    @click.prevent="sellProduct(productProfile)"
                                > {{ $t('products_table.increase_sales') }}
                                    <i class="fa fa-cart-plus"></i>
                                </a>

                                <!-- edit product -->
                                <router-link
                                    :to="{name: 'edit-product', params: {product: productProfile, id: productProfile.id}}"
                                    :href="$domain_admin + '/product/' + productProfile.id + '/edit'"
                                    class="btn btn-success btn-edit-row btn-table-actions btn-sm mt-1"
                                > {{ $t('products_table.edit_product') }}
                                    <i class="fa fa-edit"></i>
                                </router-link>

                            </div>

                            <!-- show product details in table product -->
                            <ul class="list-group list-group-unbordered mb-3">
                                <!-- product rates -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.count_rates') }}</b> <a class="float-right"> <rates-stars :rates-count="productProfile.count_rates"></rates-stars> </a>
                                </li>

                                <!-- product type -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.type') }}</b> <a class="float-right">{{ productProfile.type.name }}</a>
                                </li>

                                <!-- price -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.price') }}</b> <a class="float-right">{{ productProfile.price }}</a>
                                </li>

                                <!-- discount -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.discount') }}</b> <a class="float-right">{{ productProfile.discount !== null ? productProfile.discount + (productProfile.percent == 1 ? '%' : '') : '0' }}</a>
                                </li>

                                <!-- new price -->
                                <li class="list-group-item" v-if="productProfile.new_price !== null">
                                    <b> {{ $t('products_table.new_price') }}</b> <a class="float-right">{{ productProfile.new_price }}</a>
                                </li>

                                <!-- product counts -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.product_count') }}</b> <a class="float-right">{{ productProfile.product_count }}</a>
                                </li>

                                <!-- count selling -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.count_selling') }}</b> <a class="float-right">{{ productProfile.count_selling }}</a>
                                </li>

                                <!-- manufacture_company -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.manufacture_company') }}</b> <a class="float-right">{{ productProfile.manufacture_company }}</a>
                                </li>

                                <!-- description -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.description') }}</b> <a class="float-right">{{ productProfile.description }}</a>
                                </li>

                                <!-- run out -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.execute') }}</b> <a class="float-right">{{productProfile.execute == 1 ? $t('global.unavailable') : $t('global.available') }}</a>
                                </li>

                                <!-- display product -->
                                <li class="list-group-item">
                                    <b> {{ $t('datatable.display') }}</b> <a class="float-right">{{ productProfile.display == 1 ? $t('global.visible') : $t('global.hidden') }}</a>
                                </li>

                                <!-- Last modified -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.updated_at') }}</b> <a class="float-right">
                                        <relative-date :date="productProfile.updated_at"></relative-date>
                                    </a>
                                </li>

                                <!-- Created at -->
                                <li class="list-group-item">
                                    <b> {{ $t('products_table.created_at') }}</b> <a class="float-right">
                                        <relative-date :date="productProfile.created_at"></relative-date>
                                    </a>
                                </li>


                                <!-- company -->
                                <li class="list-group-item" v-if="$gate.isAdmin()">
                                    <b> {{ $t('products_table.company') }}</b> <a class="float-right">
                                        <router-link
                                            v-if="productProfile.company !== null"
                                            :href="$domain_admin + '/company/profile/' + productProfile.company_id"
                                            :to="{name: 'company-profile', params: {id: productProfile.company_id, company: productProfile.company}}"
                                        >
                                            {{ productProfile.company.name }}
                                        </router-link>
                                        <span class="badge badge-danger" v-else> {{ $t('global.company_is_deleted') }} - id:{{productProfile.company_id}}</span>
                                    </a>
                                </li>

                            </ul>

                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="m-0 card-title"> {{ $t('products_table.product_details') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <!-- show product details in table product_details -->

                            <table class="table table-striped table-bordered table-show-details" v-if="productProfile.details.length > 0">
                                <thead>
                                    <tr>
                                        <th> {{ $t('products_table.name') }}</th>
                                        <th> {{ $t('products_table.value') }}</th>
                                        <th class="th-display"> {{ $t('datatable.display') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="det in productProfile.details" :key="det.id">
                                        <td>{{ det.name }}</td>
                                        <td>{{ det.value }}</td>
                                        <td class="td-display">
                                            <span class="icon-success" v-if="det.display === 1">
                                                <i class="far fa-check-circle"></i>
                                            </span>
                                            <span class="icon-danger" v-else>
                                                <i class="far fa-times-circle"></i>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div v-else class="alert alert-info alert-dismissible">
                                <h5><i class="icon fas fa-info"></i> {{ $t('global.no_product_details') }} !</h5>
                                {{ $t('products_table.empty_details_msg') }}
                            </div>


                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div :class="maximizeTable == true ? 'col-table-maximize col-12' : 'col-md-12 col-xl-8'">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" style="display: inline-flex;">
                                <li class="nav-item"><a @click="showWinnerTable = false" class="nav-link active" href="#comments" data-toggle="tab">{{ $t('sidebar.comments') }}</a></li>
                                <li class="nav-item"><a @click="showWinnerTable = true" class="nav-link" href="#winners" data-toggle="tab">{{ $t('sidebar.winners') }}</a></li>

                            </ul>
                            <button class="btn btn-outline-secondary maximize-table" @click="maximizeTable = !maximizeTable"><i class="fas" :class="maximizeTable == true ? 'fa-compress-arrows-alt' : 'fa-compress'"></i></button>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            <div class="tab-pane active" id="comments">
                               <comments v-if="(productProfile.comments_count != null && productProfile.comments_count != 0) && showWinnerTable === false"></comments>

                                <div v-else class="alert alert-info alert-dismissible">
                                    <h5><i class="icon fas fa-info"></i> {{ $t('global.no_comments') }} !</h5>
                                    {{ $t('products_table.empty_comments_msg') }}
                                </div>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="winners">
                                <winners v-if="(productProfile.winners_count != null && productProfile.winners_count != 0) && showWinnerTable === true"></winners>

                                <div v-else class="alert alert-info alert-dismissible">
                                    <h5><i class="icon fas fa-info"></i> {{ $t('global.no_winners') }} !</h5>
                                    {{ $t('products_table.empty_winners_msg') }}
                                </div>

                            </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
import Winners from './../users/Index'
import Comments from './../comments/Index'
import HeaderPage from './../../components/HeaderPage'
import MixinChangeLocaleMessagesProfiles from "./../../mixins/MixinChangeLocaleMessagesProfiles"
import mixinDeleteRow from "./../../mixins/mixinDeleteRow"
import MixinsSellProduct from "./../../mixins/MixinsSellProduct"

export default {
    mixins: [
        MixinChangeLocaleMessagesProfiles,
        mixinDeleteRow,
        MixinsSellProduct
    ],
    components: {
        HeaderPage,
        Comments,
        Winners
    },
    name: 'product-profile',
    data() {
      return {
          urlProductProfile: '/product/profile',
          urlDeleteRow: '/product/destroy',
          urlSellProduct: '/product/sell',
          idPage: 'products',
          typePage: 'profile',
          maximizeTable: false,
          showWinnerTable: false,
          productProfile: {
            id: 0,
            name: "",
            price: "",
            discount: "",
            percent: 1,
            product_count: "",
            manufacture_product: "",
            description: "",
            display: 1,
            execute: 0,
            type_id: "",
            type: [],
            company: [],
            product_id: "",
            photo: "",
            gallery: "",
            details: [
                {name: '', value: '', display: true}
            ],
          }
      }
    },
    methods: {
        getProductProfile(route) {
            axios.post(this.urlProductProfile, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    let product = response.data.product
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
                        this.productProfile = product
                    } else {
                        this.$router.push({name: 'products'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getProductProfile(this.$route)
                }, 1000)
            });
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.product_profile')
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
                vm.productProfile = product
            } else {
                vm.getProductProfile(to)
            }
        })
    }
}
</script>
