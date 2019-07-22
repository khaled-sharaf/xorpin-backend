<style lang="scss">

</style>

<template>
    <tbody>
        <tr
            role="row"
            v-for="(winner, index) in dataTable"
            :key="winner.id"
            :data-id="winner.id"
            class="tr-general"
            :class="index % 2 == 0 ? 'even' : 'odd'"
        >

            <td class="td-show-plus show_plus">
            <span class="btn btn-secondary btn-show-more-row">
                <i class="fa fa-plus"></i>
            </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('index') != -1" class="index"
            >{{index + 1}}</td>


            <td v-show="tableData.filter.columns.indexOf('id') != -1" class="id"
            >{{winner.id}}</td>


            <td v-show="tableData.filter.columns.indexOf('user_id') != -1" class="user_id">
                <span class="badge badge-danger" v-if="winner.user == null">
                    {{ $t('global.user_is_deleted') }} -- id:{{winner.user_id}}
                </span>
                <router-link
                    v-else
                    class="link-router-in-table"
                    :href="$domain_admin + '/user/' + winner.user_id + '/edit'"
                    :to="{name: 'edit-user', params: {id: winner.user_id, user: winner.user}}"
                    data-name="edit-user"
                    :data-params='"{\"user\":" + JSON.stringify(winner.user) + ", \"id\":" + winner.user_id + "}"'
                    :class="{disabled: $gate.isAdminCompany()}"
                >
                    {{winner.user.name | capitalize }}
                </router-link>
            </td>

            <td v-show="tableData.filter.columns.indexOf('product_id') != -1" class="product_id">
                <span class="badge badge-danger" v-if="winner.product == null">
                    {{ $t('global.product_is_deleted') }} -- id:{{winner.product_id}}
                </span>
                <router-link
                    v-else
                    class="link-router-in-table"
                    :href="$domain_admin + '/product/profile/' + winner.product_id"
                    :to="{name: 'product-profile', params: {id: winner.product_id, product: winner.product}}"
                    data-name="product-profile"
                    :data-params='"{\"product\":" + JSON.stringify(winner.product) + ", \"id\":" + winner.product_id + "}"'
                >
                    {{winner.product.name}}
                </router-link>
            </td>


            <td v-show="tableData.filter.columns.indexOf('created_at') != -1" class="created_at">
                <relative-date :date="winner.created_at"></relative-date>
            </td>

            <td v-show="tableData.filter.columns.indexOf('actions') != -1"
                class="actions"
                >

                <!-- btn edit row -->
                <router-link
                    v-if="$gate.isAdmin()"
                    :to="{name: 'edit-winner', params: {winner: winner, id: winner.id}}"
                    :href="$domain_admin + '/winner/' + winner.id + '/edit'"
                    class="btn btn-success btn-edit-row btn-table-actions btn-sm link-router-in-table"
                    data-name="edit-winner"
                    :data-params='"{\"winner\":" + JSON.stringify(winner) + ", \"id\":" + winner.id + "}"'
                >
                    <i class="fa fa-edit"></i>
                </router-link>
                <!-- ./btn edit row -->

                <!-- btn delete row -->
                <a
                    v-if="$gate.isAdmin()"
                    :href="$domain_admin + '/winner/destroy'"
                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm"
                    @click.prevent="$emit('destroyRow', winner.id)"
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
