<style lang="scss">

</style>

<template>
    <tbody>
        <tr
            role="row"
            v-for="(setting, index) in dataTable"
            :key="setting.id"
            :data-id="setting.id"
            class="tr-general"
            :class="index % 2 == 0 ? 'even' : 'odd'"
        >

            <td class="td-show-plus show_plus">
            <span class="btn btn-secondary btn-show-more-row">
                <i class="fa fa-plus"></i>
            </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('id') != -1" class="id">
                {{setting.id}}
            </td>

            <td v-show="tableData.filter.columns.indexOf('slug') != -1" class="slug">
                {{setting.slug}}
            </td>

            <td v-show="tableData.filter.columns.indexOf('name') != -1" class="name">
                {{setting.name}}
            </td>

            <td v-show="tableData.filter.columns.indexOf('value') != -1" class="value">
                <img class="avatar-table" v-if="setting.value.indexOf('images/settings/') === 0" :src="$domain + '/' + setting.value">

                <span v-else>
                    {{setting.value}}
                </span>
            </td>

            <td v-show="tableData.filter.columns.indexOf('created_at') != -1" class="created_at">
                <relative-date :date="setting.created_at"></relative-date>
            </td>

            <td v-show="tableData.filter.columns.indexOf('actions') != -1"
                class="actions"
                >

                <!-- btn edit row -->
                <router-link
                    :to="{name: 'edit-setting', params: {setting: setting, id: setting.id}}"
                    :href="$domain_admin + '/setting/' + setting.id + '/edit'"
                    class="btn btn-success btn-edit-row btn-table-actions btn-sm link-router-in-table"
                    data-name="edit-setting"
                    :data-params='"{\"setting\":" + JSON.stringify(setting) + ", \"id\":" + setting.id + "}"'
                >
                    <i class="fa fa-edit"></i>
                </router-link>
                <!-- ./btn edit row -->

                <!-- btn delete row -->
                <a
                    :href="$domain_admin + '/setting/destroy'"
                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm"
                    @click.prevent="$emit('destroyRow', setting.id)"
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
