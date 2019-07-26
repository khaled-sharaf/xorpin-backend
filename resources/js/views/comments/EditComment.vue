<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('sidebar.edit_comment')"></header-page>
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
                                        {{ $t('global.user_commented') }} :
                                        <span class="badge badge-danger" v-if="commentEdit.user == null">
                                            {{ $t('global.user_is_deleted') }} -- id:{{commentEdit.user_id}}
                                        </span>
                                        <span v-else style="color: #3498db"> {{ commentEdit.user.name }}</span></h3>
                                </h3>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="editComment()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-comment typeForm="edit" :form="form"></form-comment>
                                </div>
                                <!-- ./card-body -->


                                <!-- card-footer -->
                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        :disabled="form.busy"
                                        class="btn btn-success float-right"
                                    >{{ $t('global.update') }}</button>
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
import FormComment from './FormComment'
import HeaderPage from './../../components/HeaderPage'

import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    components: {
        HeaderPage,
        FormComment
    },
    data() {
      return {
        urlEditComment: '/comment/edit',
        urlUpdateComment: '/comment/update',
        form: new Form({
            id: 0,
            text_comment: "",
            positive_product: "",
            negative_product: "",
            display: 1,
            user_id: "",
            product_id: "",
        }),
        commentEdit: {},
        idPage: 'comments',
        typePage: 'edit'
      }
    },
    methods: {
        editComment() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateComment).then(response => {
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
        getCommentEdit(route) {
            axios.post(this.urlEditComment, {id: route.params.id}).then(response => {
                if (response.status === 200) {
                    const comment = response.data.comment
                    if (comment != null) {
                        this.commentEdit = comment
                        this.form.reset()
                        this.form.fill(this.commentEdit)
                    } else {
                        this.$router.push({name: 'comments'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getCommentEdit(this.$route)
                }, 1000)
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_comment')
            if (to.params.comment) {
                vm.commentEdit = to.params.comment
                vm.form.reset()
                vm.form.fill(vm.commentEdit)
            } else {
                vm.getCommentEdit(to)
            }
        })
    }
}
</script>
