<template>
  <table class="table dataTable" :class="' table-' + viewtableclasses.join(' table-')">
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
</template>

<script>
export default {
  props: [
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
