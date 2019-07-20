<template>
    <!-- search -->
    <div class="dataTables_search">
        <div class="view-search">
            <input
                type="search"
                class="form-control form-control-sm"
                v-model="tableData.search"
                :placeholder="$t('datatable.search')"
                @input="$emit('getData')"
            >
            <span class="icon search">
                <i class="fas fa-search"></i>
            </span>
            <span
                class="icon delete"
                @click="tableData.search = ''; $emit('getData');"
                v-if="tableData.search.length"
            >
            <i class="fas fa-times-circle"></i>
            </span>
        </div>
    </div>
</template>





<script>
export default {
    props: [
    "tableData"
  ],
}
</script>

