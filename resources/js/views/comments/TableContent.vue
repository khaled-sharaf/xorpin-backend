<style lang="scss">

</style>

<template>
    <tbody>
        <tr
            role="row"
            v-for="(comment, index) in dataTable"
            :key="comment.id"
            :data-id="comment.id"
            class="tr-general"
            :class="index % 2 == 0 ? 'even' : 'odd'"
        >

            <td class="td-show-plus show_plus">
            <span class="btn btn-secondary btn-show-more-row">
                <i class="fa fa-plus"></i>
            </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('index') != -1" class="index">
                {{index + 1}}
            </td>


            <td v-show="tableData.filter.columns.indexOf('id') != -1" class="id">
                {{comment.id}}
            </td>


            <td v-show="tableData.filter.columns.indexOf('text_comment') != -1" class="text_comment">
                {{comment.text_comment}}
            </td>

            <!-- <td v-show="tableData.filter.columns.indexOf('positive_product') != -1" class="positive_product">
                {{comment.positive_product}}
            </td>

            <td v-show="tableData.filter.columns.indexOf('negative_product') != -1" class="negative_product">
                {{comment.negative_product}}
            </td> -->

            <td v-show="tableData.filter.columns.indexOf('user_id') != -1" class="user_id">
                <span class="badge badge-danger" v-if="comment.user == null">
                    {{ $t('global.user_is_deleted') }} -- id:{{comment.user_id}}
                </span>
                <router-link
                    v-else
                    class="link-router-in-table"
                    :href="$domain_admin + '/user/' + comment.user_id + '/edit'"
                    :to="{name: 'edit-user', params: {id: comment.user_id, user: comment.user}}"
                    data-name="edit-user"
                    :data-params='"{\"user\":" + JSON.stringify(comment.user) + ", \"id\":" + comment.user_id + "}"'
                    :class="{disabled: $gate.isAdminCompany()}"
                >
                    {{comment.user.name | capitalize }}
                </router-link>
            </td>

            <td v-show="tableData.filter.columns.indexOf('product_id') != -1" class="product_id">
                <span class="badge badge-danger" v-if="comment.product == null">
                    {{ $t('global.product_is_deleted') }} -- id:{{comment.product_id}}
                </span>
                <router-link
                    v-else
                    class="link-router-in-table"
                    :href="$domain_admin + '/product/profile/' + comment.product_id"
                    :to="{name: 'product-profile', params: {id: comment.product_id, product: comment.product}}"
                    data-name="product-profile"
                    :data-params='"{\"product\":" + JSON.stringify(comment.product) + ", \"id\":" + comment.product_id + "}"'
                    :class="{disabled: $gate.isAdminCompany()}"
                >
                    {{comment.product.name}}
                </router-link>
            </td>

            <td v-show="tableData.filter.columns.indexOf('display') != -1" class="display">
                <span class="icon-info" v-if="comment.display == 1">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="icon-warning" v-if="comment.display == 0">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('created_at') != -1" class="created_at">
                <relative-date :date="comment.created_at"></relative-date>
            </td>

            <td v-show="tableData.filter.columns.indexOf('actions') != -1"
                class="actions"
                >

                <!-- btn edit row -->
                <router-link
                    v-if="$gate.isAdmin()"
                    :to="{name: 'edit-comment', params: {comment: comment, id: comment.id}}"
                    :href="$domain_admin + '/comment/' + comment.id + '/edit'"
                    class="btn btn-success btn-edit-row btn-table-actions btn-sm link-router-in-table"
                    data-name="edit-comment"
                    :data-params='"{\"comment\":" + JSON.stringify(comment) + ", \"id\":" + comment.id + "}"'
                >
                    <i class="fa fa-edit"></i>
                </router-link>
                <!-- ./btn edit row -->

                <!-- btn delete row -->
                <a
                    v-if="$gate.isAdmin()"
                    :href="$domain_admin + '/products-type/destroy'"
                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm"
                    @click.prevent="$emit('destroyRow', comment.id)"
                >
                    <i class="fa fa-trash"></i>
                </a>
                <!-- ./ btn delete row -->


            </td>
        </tr>
    </tbody>
</template>




<script>
export default {
    props: [
        'dataTable',
        'tableData',
    ]
}
</script>
