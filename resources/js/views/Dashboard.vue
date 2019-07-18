<style>


</style>

<template>
    <div>
        <header-page title="Dashboard"></header-page>
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ counts.users }}</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <router-link :to="{name: 'users'}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->



                    <div class="col-lg-3 col-6" v-if="$gate.isAdmin()">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ counts.companies }}</h3>

                            <p>Companies</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <router-link :to="{name: 'companies'}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->



                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ counts.products }}</h3>

                            <p>Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <router-link :to="{name: 'products'}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ counts.winners }}</h3>

                            <p>Winners</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <router-link :to="{name: 'winners'}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ counts.comments }}</h3>

                            <p>Comments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <router-link :to="{name: 'comments'}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->

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
                    products: 0,
                    winners: 0,
                    comments: 0,
                },
                urlGetCounts: '/get-row-counts-in-form-models'
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
            }
        },
        mounted() {
            this.getCountsAllModels()
        }
    }
</script>
