<style lang="scss">

</style>

<template>
    <tbody>
        <tr
            role="row"
            v-for="(proTtype, index) in dataTable"
            :key="proTtype.id"
            :data-id="proTtype.id"
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
            >{{proTtype.id}}</td>


            <td v-show="tableData.filter.columns.indexOf('name') != -1" class="name"
            >{{proTtype.name | capitalize }}</td>


            <td v-show="tableData.filter.columns.indexOf('display') != -1" class="display">
                <span class="icon-info" v-if="proTtype.display == 1">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="icon-warning" v-if="proTtype.display == 0">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('created_at') != -1" class="created_at">
                <relative-date :date="proTtype.created_at"></relative-date>
            </td>

            <td v-show="tableData.filter.columns.indexOf('actions') != -1"
                class="actions"
                >

                <!-- btn edit row -->
                <router-link
                    v-if="$gate.isAdmin()"
                    v-show="proTtype.deleted_at == null"
                    :to="{name: 'edit-pro-type', params: {proTtype: proTtype, id: proTtype.id}}"
                    :href="$domain_admin + '/products-type/' + proTtype.id + '/edit'"
                    class="btn btn-success btn-edit-row btn-table-actions btn-sm link-router-in-table"
                    data-name="edit-pro-type"
                    :data-params='"{\"proTtype\":" + JSON.stringify(proTtype) + ", \"id\":" + proTtype.id + "}"'
                >
                    <i class="fa fa-edit"></i>
                </router-link>
                <!-- ./btn edit row -->

                <!-- btn delete row -->
                <a
                    v-if="$gate.isAdmin()"
                    v-show="proTtype.deleted_at == null"
                    :href="$domain_admin + '/products-type/destroy'"
                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm"
                    @click.prevent="$emit('destroyRow', proTtype.id)"
                >
                    <i class="fa fa-trash"></i>
                </a>
                <!-- ./ btn delete row -->


                <!-- btn restore row -->
                <a
                    v-if="$gate.isAdmin()"
                    v-show="proTtype.deleted_at != null"
                    :href="$domain_admin + '/products-type/restore'"
                    class="btn btn-info btn-restore-row btn-table-actions btn-sm"
                    @click.prevent="$emit('restoreRow', proTtype.id)"
                >
                    <i class="fas fa-undo-alt"></i>
                </a>
                <!-- ./ btn restore row -->

                <!-- btn delete row -->
                <a
                    v-if="$gate.isAdmin()"
                    v-show="proTtype.deleted_at != null"
                    :href="$domain_admin + '/products-type/force-delete'"
                    class="btn btn-danger btn-delete-row force-delete btn-table-actions btn-sm"
                    @click.prevent="$emit('forceDeleteRow', proTtype.id)"
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
