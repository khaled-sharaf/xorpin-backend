<style lang="scss">

</style>

<template>
    <tbody>
        <tr
            role="row"
            v-for="(product, index) in dataTable"
            :key="product.id"
            :data-id="product.id"
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
            >{{product.id}}</td>


            <td v-show="tableData.filter.columns.indexOf('name') != -1" class="name"
            >{{product.name | capitalize }}</td>


            <td v-show="tableData.filter.columns.indexOf('photo') != -1"
                class="photo" style="text-align:center;">
                <img class="avatar-table" :src="$domain + '/' + product.photo">
            </td>


            <td v-show="tableData.filter.columns.indexOf('price') != -1" class="price">
                <div class="wrapper-price">
                    <span v-text="product.price" class="show-price" :class="product.discount !== null && product.discount !== 0 ? 'old-price' : 'default-price'"></span>
                    <span class="new-price" v-text="product.new_price" v-if="product.discount !== null && product.discount !== 0"></span>
                    <span class="discount" v-if="product.discount !== null && product.discount !== 0">
                        {{ product.discount + (product.percent === 1 ? '%' : '') }}
                    </span>
                </div>
            </td>


            <td v-show="tableData.filter.columns.indexOf('description') != -1" class="description">
                {{product.description}}
            </td>


            <td v-show="tableData.filter.columns.indexOf('manufacture_company') != -1" class="manufacture_company">
                {{product.manufacture_company}}
            </td>


            <td v-show="tableData.filter.columns.indexOf('count_rates') != -1" class="count_rates">
                <rates-stars :rates-count="product.count_rates"></rates-stars> <span style="display: inline-block; position: relative; top: -12px;">( {{ product.rate_user_count }} )</span>
                <div class="text-center" style="font-size: 11px;">{{ product.count_rates }}</div>
            </td>


            <td v-show="tableData.filter.columns.indexOf('product_count') != -1" class="product_count">
                {{product.product_count}}
            </td>


            <td v-show="tableData.filter.columns.indexOf('count_selling') != -1" class="count_selling">
                {{product.count_selling}}
            </td>


            <td v-show="tableData.filter.columns.indexOf('execute') != -1" class="execute">
                <span class="icon-success" v-if="product.execute == 0">
                    <i class="far fa-check-circle"></i>
                </span>
                <span class="icon-danger" v-if="product.execute == 1">
                    <i class="far fa-times-circle"></i>
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('display') != -1" class="display">
                <span class="icon-info" v-if="product.display == 1">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="icon-warning" v-if="product.display == 0">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('type') != -1" class="type">
                <span class="badge badge-danger" v-if="product.type == null">
                    {{ $t('global.type_is_deleted') }} -- id:{{product.type_id}}
                </span>
                <span v-else>
                    {{ product.type.name }}
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('user') != -1" class="user"
            >
                <router-link
                    v-if="product.user !== null"
                    class="link-router-in-table"
                    :href="$domain_admin + '/user/' + product.user_id + '/edit'"
                    :to="{name: 'edit-user', params: {user: product.user, id: product.user_id}}"
                    data-name="edit-user"
                    :data-params='"{\"user\":" + JSON.stringify(product.user) + ", \"id\":" + product.user_id + "}"'
                    :class="{disabled: $gate.isAdminCompany()}"
                >
                    {{product.user.name}}
                </router-link>

                <span class="badge badge-danger" v-else>
                    {{ $t('global.user_is_deleted') }} -- id:{{product.user_id}}
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('company') != -1" class="company">
                <router-link
                    class="link-router-in-table"
                    v-if="product.company !== null"
                    :href="$domain_admin + '/company/profile/' + product.company_id"
                    :to="{name: 'company-profile', params: {id: product.company_id, company: product.company}}"
                    data-name="company-profile"
                    :data-params='"{\"company\":" + JSON.stringify(product.company) + ", \"id\":" + product.company_id + "}"'
                    :class="{disabled: $gate.isAdminCompany()}"
                >
                    {{product.company.name}}
                </router-link>
                <span v-else class="badge badge-danger">
                    {{ $t('global.company_is_deleted') }}
                     -- id:{{product.company_id}}
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('updated_at') != -1" class="updated_at">
                <relative-date v-if="product.updated_at !== null" :date="product.updated_at"></relative-date>
                <span v-else>No modification</span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('created_at') != -1" class="created_at">
                <relative-date :date="product.created_at"></relative-date>
            </td>


            <td v-show="tableData.filter.columns.indexOf('actions') != -1"
                class="actions"
                >
                <!-- show product profile  -->
                <router-link
                    v-show="product.deleted_at == null"
                    :to="{name: 'product-profile', params: {product: product, id: product.id}}"
                    :href="$domain_admin + '/product/profile/' + product.id"
                    class="btn btn-info btn-show-profile btn-table-actions btn-sm link-router-in-table"
                    data-name="product-profile"
                    :data-params='"{\"product\":" + JSON.stringify(product) + ", \"id\":" + product.id + "}"'
                >
                    <i class="fas fa-eye"></i>
                </router-link>

                <!-- btn delete row -->
                <a
                    v-show="product.deleted_at == null"
                    :href="$domain_admin + '/product/sell'"
                    class="btn btn-secondary btn-sell-product btn-table-actions btn-sm"
                    @click.prevent="$emit('sellProduct', product)"
                >
                    <i class="fa fa-cart-plus"></i>
                </a>
                <!-- ./ btn delete row -->


                <!-- btn edit row -->
                <router-link
                    v-show="product.deleted_at == null"
                    :to="{name: 'edit-product', params: {product: product, id: product.id}}"
                    :href="$domain_admin + '/product/' + product.id + '/edit'"
                    class="btn btn-success btn-edit-row btn-table-actions btn-sm link-router-in-table"
                    data-name="edit-product"
                    :data-params='"{\"product\":" + JSON.stringify(product) + ", \"id\":" + product.id + "}"'
                >
                    <i class="fa fa-edit"></i>
                </router-link>
                <!-- ./btn edit row -->

                <!-- btn delete row -->
                <a
                    v-show="product.deleted_at == null"
                    :href="$domain_admin + '/product/destroy'"
                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm"
                    @click.prevent="$emit('destroyRow', product.id)"
                >
                    <i class="fa fa-trash"></i>
                </a>
                <!-- ./ btn delete row -->


                <!-- btn restore row -->
                <a
                    v-if="$gate.isAdmin()"
                    v-show="product.deleted_at != null"
                    :href="$domain_admin + '/product/restore'"
                    class="btn btn-info btn-restore-row btn-table-actions btn-sm"
                    @click.prevent="$emit('restoreRow', product.id)"
                >
                    <i class="fas fa-undo-alt"></i>
                </a>
                <!-- ./ btn restore row -->

                <!-- btn delete row -->
                <a
                    v-if="$gate.isAdmin()"
                    v-show="product.deleted_at != null"
                    :href="$domain_admin + '/product/force-delete'"
                    class="btn btn-danger btn-delete-row force-delete btn-table-actions btn-sm"
                    @click.prevent="$emit('forceDeleteRow', product.id)"
                >
                    <i class="far fa-trash-alt"></i>
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
