<template>
<div>
    <div class="wrapper-loading" v-show="!successResponse">
        <div class="loading">
            <img :src="$domain + '/admin/images/loader.gif'">
        </div>
    </div>
    <table class="table dataTable" :class="' table-' + viewtableclasses.join(' table-')" v-if="dataTable.length">
        <thead class="thead-light">
            <tr>
                <th class="actions th-show-plus" v-html="columns[0].label"></th>
                <th
                rowspan="1"
                colspan="1"
                v-for="column in columns"
                v-show="columnsView.indexOf(column.name) != -1"
                :key="column.name"
                @click="(columnsExcepted.indexOf(column.name) == -1) ? $emit('sort', column.name) : ''"
                :class="(columnsExcepted.indexOf(column.name) == -1) ? (sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting') : 'actions'"
                v-html="column.label"
                ></th>
            </tr>
        </thead>
        <slot></slot>
        <tfoot class="thead-light">
            <tr>
                <th class="actions th-show-plus" v-html="columns[0].label"></th>
                <th
                rowspan="1"
                colspan="1"
                v-for="column in columns"
                v-show="columnsView.indexOf(column.name) != -1"
                :key="column.name"
                @click="(columnsExcepted.indexOf(column.name) == -1) ? $emit('sort', column.name) : ''"
                :class="(columnsExcepted.indexOf(column.name) == -1) ? (sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting') : 'actions'"
                v-html="column.label"
                ></th>
            </tr>
        </tfoot>
    </table>
  <div v-if="!dataTable.length && successResponse === true" class="alert alert-danger alert-dismissible">
        <h5><i class="icon fas fa-info"></i> {{ $t('datatable.empty_table') }}!</h5>
        {{ $t('datatable.no_data_msg') }}
    </div>
</div>
</template>

<script>
export default {
  props: [
    "successResponse",
    "dataTable",
    "columns",
    "viewtableclasses",
    "columnsView",
    "columnsExcepted",
    "sortKey",
    "sortOrders"
  ]
};
</script>


<style lang="scss">

</style>
