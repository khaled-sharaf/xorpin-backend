<template>
    <!-- trashed -->
    <div class="box column_active">
        <div class="filter filter_one">
            <div class="header">{{$t('datatable.trashed')}}</div>
            <div class="body">
                <span
                    class="icon icon-success"
                    :class="tableData.trashed == '1' ? 'active' : ''"
                    @click="tableData.trashed = '1'; $emit('getData');"
                >
                    <i class="fas fa-heart"></i>
                </span>
                <span
                    class="icon icon-danger"
                    :class="tableData.trashed == '0' ? 'active' : ''"
                    @click="tableData.trashed = '0'; $emit('getData');"
                >
                    <i class="fas fa-trash"></i>
                </span>
                <span
                    class="icon off"
                    :class="tableData.trashed == '2' ? 'active' : ''"
                    @click="tableData.trashed = '2'; $emit('getData');"
                >
                    <i class="fas fa-power-off"></i>
                </span>
            </div>
        </div>
        <!-- ./filter-one-->
    </div>
    <!-- ./box-->
</template>





<script>
export default {
    props: [
    "tableData"
  ],
}
</script>

