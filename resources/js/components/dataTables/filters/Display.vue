<template>
    <!-- Display -->
    <div class="box column_active">
        <div class="filter filter_one">
            <div class="header">{{$t('datatable.display')}}</div>
            <div class="body">
            <span
                class="icon icon-success"
                :class="tableData.display == '1' ? 'active' : ''"
                @click="tableData.display = '1'; $emit('getData');"
            >
                <i class="fas fa-eye"></i>
            </span>
            <span
                class="icon icon-danger"
                :class="tableData.display == '0' ? 'active' : ''"
                @click="tableData.display = '0'; $emit('getData');"
            >
                <i class="fas fa-eye-slash"></i>
            </span>
            <span
                class="icon off"
                :class="tableData.display == '' ? 'active' : ''"
                @click="tableData.display = ''; $emit('getData');"
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

