<template>
    <!-- Products type -->
    <div class="box column_active">
        <div class="filter filter_one">
            <div class="header"> {{$t('datatable.products_type')}} </div>
            <div class="body">
                <div class="wrapper-select-item">
                    <select class="custom-select custom-select-sm" v-model="tableData.type_id" @change="$emit('getData')">
                        <option value="">{{$t('global.all')}}</option>
                        <option :value="type.id" v-for="type in proTypes" :key="type.id" v-text="type.name"></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- ./box-->
</template>





<script>
export default {
    props: [
    "tableData",
    "proTypes"
  ],
}
</script>

