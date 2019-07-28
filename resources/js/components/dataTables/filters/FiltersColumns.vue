<template>
    <div class="dataTables_filter">

        <!-- dataTables_length -->
        <label class="dataTables_length">
            <select class="custom-select" v-model="tableData.length" @change="$emit('getData')">
                <option
                    v-for="(records, index) in perPage"
                    :key="index"
                    :value="records"
                >{{records}}</option>
            </select>
        </label>
        <!-- ./dataTables_length -->

        <!-- dataTables_columns -->
        <label class="dataTables_columns custom-select" v-selectcolumnopen>
            <select
                class="custom-select view-columns-filter"
                v-model="tableData.filter.columns"
                v-selectcolumn="tableData.filter.columns"
                multiple="multiple"
            >
                <option
                    v-for="(column, index) in updatedColumns"
                    v-show="column.name != 'show_plus'"
                    :key="index"
                    :value="column.name"
                    v-html="column.label"
                ></option>
            </select>
            <span class="icon">
                <i class="fas fa-eye"></i>
            </span>
        </label>
        <!-- ./dataTables_columns -->

        <!-- dataTables_viewtable -->
        <label class="dataTables_viewtable custom-select" v-selectcolumnopen>
            <select
                class="custom-select view-table-filter"
                v-model="tableData.filter.viewTable"
                v-selectviewtableclass="tableData.filter.viewTable"
                multiple="multiple"
            >
            <option
                v-for="(viewclass, index) in viewTableClasses"
                :key="index"
                :value="viewclass"
            >{{viewclass}}</option>
            </select>
            <span class="icon">
            <i class="fas fa-table"></i>
            </span>
        </label>
        <!-- ./dataTables_viewtable -->

        <!-- dataTables_refresh -->
        <label class="dataTables_refresh">
            <button class="btn btn-outline-secondary" @click="$emit('getData')">
            <i class="fas fa-sync-alt"></i>
            </button>
        </label>
        <!-- ./dataTables_refresh -->

    </div>
</template>





<script>
export default {
    props: [
        "columns",
        "viewTableClasses",
        "tableData",
        "perPage"
    ],
    data() {
        return {
            updatedColumns: []
        }
    },
    methods: {
        updateColumns() {
            this.updatedColumns = this.columns
        }
    },
    watch: {
        "$i18n.locale"(val) {
            this.updatedColumns = []
            setTimeout(() => {
                this.updateColumns()
            })
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.updateColumns()
        })
    },
}
</script>

