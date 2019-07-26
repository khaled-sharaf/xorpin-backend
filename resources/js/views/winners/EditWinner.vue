<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('sidebar.edit_winner')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="m-0 mb-2 text-dark">
                                    <h3 class="m-0 mb-2 text-dark">
                                        {{ $t('global.winner') | capitalize }}:
                                        <span class="badge badge-danger" v-if="winnerEdit.user == null">
                                            {{ $t('global.user_is_deleted') }} -- id:{{winnerEdit.user_id}}
                                        </span>
                                        <span v-else style="color: #3498db"> {{ winnerEdit.user.name }}</span></h3>
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
                                    > {{ $t('global.update') }} </button>
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
import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
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
        winnerEdit: {},
        idPage: 'winners',
        typePage: 'edit'
      }
    },
    methods: {
        editWinner() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateWinner).then(response => {
                if (response.status === 200) {
                    this.companyEdit = response.data.data;
                    ToastReq.fire({
                        text: this.success_msg
                    });
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
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
