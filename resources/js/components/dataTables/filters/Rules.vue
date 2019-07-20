<template>
    <!-- Rules -->
    <div class="box column_rule">
        <div class="filter filter_one">
            <div class="header">{{$t('datatable.rules')}}</div>
            <div class="body" style="flex-wrap: nowrap;">
                <span
                    class="icon admin"
                    :class="tableData.rule == '1' ? 'active' : ''"
                    @click="tableData.rule = '1'; $emit('getData');"
                >Admin</span>

                <span
                    class="icon company"
                    :class="tableData.rule == '2' ? 'active' : ''"
                    @click="tableData.rule = '2'; $emit('getData');"
                >Company</span>

                <span
                    class="icon user"
                    :class="tableData.rule == '0' ? 'active' : ''"
                    @click="tableData.rule = '0'; $emit('getData');"
                >User</span>

                <span
                    class="icon off"
                    :class="tableData.rule == '' ? 'active' : ''"
                    @click="tableData.rule = ''; $emit('getData');"
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

