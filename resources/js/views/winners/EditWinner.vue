<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Edit winner"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="m-0 mb-2 text-dark">
                                    <h3 class="m-0 mb-2 text-dark">Winner: <span style="color: #3498db"> {{ winnerEdit.user.name }}</span></h3>
                                </h3>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="editWinner()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-winner typeForm="edit" :form="form"></form-winner>
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
import FormWinner from './FormWinner'
import HeaderPage from './../../components/HeaderPage'
export default {
    components: {
        HeaderPage,
        FormWinner
    },
    data() {
      return {
        urlEditWinner: '/winner/edit',
        urlUpdateWinner: '/winner/update',
        form: new Form({
          id: 0,
          user_id: "",
          product_id: "",
        }),
        winnerEdit: {}
      }
    },
    methods: {
        editWinner() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateWinner).then(response => {
                if (response.status === 200) {
                    this.companyEdit = response.data.data;
                    ToastReq.fire({
                        text: response.data.message
                    });
                }
            }).catch(response => {
                Swal.fire("Failed!", "The winner has not been created.", "error");
                this.$Progress.fail();
            });
        },
        getWinnerEdit(route) {
            axios.post(this.urlEditWinner, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    const winner = response.data.winner
                    if (winner != null) {
                        this.winnerEdit = winner

                        this.form.reset()
                        this.form.fill(this.winnerEdit)
                    } else {
                        this.$router.push({name: 'winners'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getWinnerEdit(this.$route)
                }, 1000)
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_winner')
            if (to.params.winner) {
                vm.winnerEdit = to.params.winner
                vm.form.reset()
                vm.form.fill(vm.winnerEdit)
            } else {
                vm.getWinnerEdit(to)
            }
        })
    }
}
</script>
