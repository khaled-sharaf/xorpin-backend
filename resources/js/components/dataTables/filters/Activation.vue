<template>
    <!-- Activation -->
    <div class="box column_active">
        <div class="filter filter_one">
            <div class="header"> {{$t('datatable.activation')}} </div>
            <div class="body">
                <span
                    class="icon icon-success"
                    :class="tableData.active == '1' ? 'active' : ''"
                    @click="tableData.active = '1'; $emit('getData');"
                >
                    <i class="fas fa-check-circle"></i>
                </span>
                <span
                    class="icon icon-danger"
                    :class="tableData.active == '0' ? 'active' : ''"
                    @click="tableData.active = '0'; $emit('getData');"
                >
                    <i class="fas fa-times-circle"></i>
                </span>
                <span
                    class="icon off"
                    :class="tableData.active == '' ? 'active' : ''"
                    @click="tableData.active = ''; $emit('getData');"
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

