<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page title="Edit products type"></header-page>
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
                            <form @submit.prevent="editProductType()">
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
        editProductType() {
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
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (to.params.winner) {
                vm.winnerEdit = to.params.winner
                vm.form.reset()
                vm.form.fill(vm.winnerEdit)
            } else {
                axios.post(vm.urlEditWinner, {id: to.params.id}).then(response => {
                    if (response.status === 200) {
                        const winner = response.data.winner
                        if (winner != null) {
                            vm.winnerEdit = winner

                            vm.form.reset()
                            vm.form.fill(vm.winnerEdit)
                        } else {
                            vm.$router.push({name: 'winners'})
                        }
                    }
                })
            }
        })
    }
}
</script>
