<style lang="scss">

</style>

<template>
    <tbody>
        <tr
            role="row"
            v-for="(contact, index) in dataTable"
            :key="contact.id"
            :data-id="contact.id"
            class="tr-general"
            :class="index % 2 == 0 ? 'even' : 'odd'"
        >

            <td class="td-show-plus show_plus">
                <span class="btn btn-secondary btn-show-more-row">
                    <i class="fa fa-plus"></i>
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('id') != -1" class="id">
                {{contact.id}}
            </td>

            <td v-show="tableData.filter.columns.indexOf('name') != -1" class="name">
                {{contact.name}}
            </td>

            <td v-show="tableData.filter.columns.indexOf('email') != -1" class="email">
                {{contact.email}}
            </td>

            <td v-show="tableData.filter.columns.indexOf('message') != -1" class="message">
                {{contact.message}}
            </td>

            <td v-show="tableData.filter.columns.indexOf('created_at') != -1" class="created_at">
                <relative-date :date="contact.created_at"></relative-date>
            </td>

            <td v-show="tableData.filter.columns.indexOf('actions') != -1"
                class="actions"
                >

                <!-- btn delete row -->
                <a
                    :href="$domain_admin + '/contact-us/destroy'"
                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm"
                    @click.prevent="$emit('destroyRow', contact.id)"
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
