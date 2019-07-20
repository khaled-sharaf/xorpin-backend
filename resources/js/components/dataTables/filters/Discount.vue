<template>
    <!-- Discount -->
    <div class="box column_active">
        <div class="filter filter_one">
            <div class="header">{{$t('datatable.discount')}}</div>
            <div class="body">
            <span
                class="icon icon-success"
                :class="tableData.discount == '1' ? 'active' : ''"
                @click="tableData.discount = '1'; $emit('getData');"
            >
                <i class="fas fa-percent"></i>
            </span>
            <span
                class="icon icon-danger"
                :class="tableData.discount == '0' ? 'active' : ''"
                @click="tableData.discount = '0'; $emit('getData');"
            >
                <i class="fas fa-minus"></i>
            </span>
            <span
                class="icon off"
                :class="tableData.discount == '' ? 'active' : ''"
                @click="tableData.discount = ''; $emit('getData');"
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

