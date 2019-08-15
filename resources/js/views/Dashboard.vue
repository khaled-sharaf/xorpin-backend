<style>


</style>

<template>
    <div>
        <header-page :title="$t('global.dashboard')"></header-page>
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row mt-3">

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ counts.users }}</h3>

                            <p>{{ $t('sidebar.users') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <router-link :to="{name: 'users'}" class="small-box-footer">
                            {{ $t('global.more_info') }} <i class="fas" :class="$i18n.locale == 'ar' ? 'fa-arrow-circle-left' : 'fa-arrow-circle-right'"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->



                    <div class="col-lg-3 col-6" v-if="$gate.isAdmin()">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ counts.companies }}</h3>

                            <p>{{ $t('sidebar.companies') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <router-link :to="{name: 'companies'}" class="small-box-footer">
                            {{ $t('global.more_info') }} <i class="fas" :class="$i18n.locale == 'ar' ? 'fa-arrow-circle-left' : 'fa-arrow-circle-right'"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->



                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ counts.categories }}</h3>

                            <p>{{ $t('sidebar.products_types') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <router-link :to="{name: 'pro-types'}" class="small-box-footer">
                            {{ $t('global.more_info') }} <i class="fas" :class="$i18n.locale == 'ar' ? 'fa-arrow-circle-left' : 'fa-arrow-circle-right'"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->



                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ counts.products }}</h3>

                            <p>{{ $t('sidebar.products') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <router-link :to="{name: 'products'}" class="small-box-footer">
                            {{ $t('global.more_info') }} <i class="fas" :class="$i18n.locale == 'ar' ? 'fa-arrow-circle-left' : 'fa-arrow-circle-right'"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ counts.winners }}</h3>

                            <p>{{ $t('sidebar.winners') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <router-link :to="{name: 'winners'}" class="small-box-footer">
                            {{ $t('global.more_info') }} <i class="fas" :class="$i18n.locale == 'ar' ? 'fa-arrow-circle-left' : 'fa-arrow-circle-right'"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ counts.comments }}</h3>

                            <p>{{ $t('sidebar.comments') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <router-link :to="{name: 'comments'}" class="small-box-footer">
                            {{ $t('global.more_info') }} <i class="fas" :class="$i18n.locale == 'ar' ? 'fa-arrow-circle-left' : 'fa-arrow-circle-right'"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->


                    <!-- <h1 @click="loginTest()">Login</h1> -->

                </div>
                <!-- /.row -->

            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
    import HeaderPage from './../components/HeaderPage'
    export default {
        components: {
            HeaderPage
        },
        data() {
            return {
                counts: {
                    users: 0,
                    companies: 0,
                    categories: 0,
                    products: 0,
                    winners: 0,
                    comments: 0,
                },
                urlGetCounts: '/get-tables-count'
            }
        },
        methods: {
            getCountsAllModels() {
                axios.post(this.urlGetCounts).then(response => {
                    if (response.status === 200) {
                        this.counts = response.data.counts
                    }
                })
                .catch(errors => {
                    setTimeout(() => {
                        this.getCountsAllModels()
                    }, 1000)
                });
            },
            loginTest() {
                const postData = {
                    grant_type: 'password',
                    client_id: '1',
                    client_secret: 'oU1c3pC4YEqhnsfdvEHQcXYFZgVcHtM1PIMxGk4k',
                    username: 'user@user.com',
                    password: 622136,
                    socpe: ''
                }

                axios.post(this.$domain + '/oauth/token', postData)
                .then(response => {
                    console.log(response)
                })
                .catch(errors => {
                    console.log(errors.response)
                })
            }
        },
        mounted() {
            this.getCountsAllModels()
        },
        beforeRouteEnter (to, from, next) {
            next(vm => {
                to.meta.title = vm.$t('global.dashboard')
            })
        }
    }
</script>
