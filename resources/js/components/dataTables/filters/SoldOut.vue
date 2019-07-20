<template>
    <!-- Sold Out -->
    <div class="box column_active">
        <div class="filter filter_one">
            <div class="header">{{$t('datatable.sold_out')}}</div>
            <div class="body">
            <span
                class="icon icon-success"
                :class="tableData.execute == '0' ? 'active' : ''"
                @click="tableData.execute = '0'; $emit('getData');"
            >
                <i class="fas fa-check-circle"></i>
            </span>
            <span
                class="icon icon-danger"
                :class="tableData.execute == '1' ? 'active' : ''"
                @click="tableData.execute = '1'; $emit('getData');"
            >
                <i class="fas fa-times-circle"></i>
            </span>
            <span
                class="icon off"
                :class="tableData.execute == '' ? 'active' : ''"
                @click="tableData.execute = ''; $emit('getData');"
            >
                <i class="fas fa-power-off"></i>
            </span>
            </div>
        </div>
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

