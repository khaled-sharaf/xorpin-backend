<style lang="scss">

</style>



<template>
    <div>
        <div class="dataTables_filters">
            <div class="box column_active" v-if="this.$route.name != 'product-profile' && $gate.isAdmin()">
                <div class="filter filter_one">
                    <div class="header">Trashed</div>
                    <div class="body">
                        <span
                            class="icon icon-success"
                            :class="tableData.trashed == '1' ? 'active' : ''"
                            @click="tableData.trashed = '1'; $emit('getData');"
                        >
                            <i class="fas fa-users"></i>
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

            <div class="box column_active">
                <div class="filter filter_one">
                    <div class="header">Activation</div>
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
            <div class="box column_rule" v-if="this.$route.name == 'users'">
                <div class="filter filter_one">
                    <div class="header">Rules</div>
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
            <!-- ./filter-one-->
            </div>
            <!-- ./box-->
            <div class="box column_date_between">
                <div class="filter filter_date">
                    <div class="header">Created Between</div>
                    <div class="body">
                        <span class="input-date from">
                            <date-picker
                            v-model="tableData.from_date"
                            type="datetime"
                            lang="en"
                            format="YYYY-MM-DD hh:mm:ss"
                            placeholder="Form"
                            confirm
                            ></date-picker>
                        </span>
                        <span class="input-date to">
                            <date-picker
                            v-model="tableData.to_date"
                            type="datetime"
                            lang="en"
                            format="YYYY-MM-DD hh:mm:ss"
                            placeholder="To"
                            confirm
                            ></date-picker>
                        </span>
                    </div>
                </div>
                <!-- ./filter-one-->
            </div>
            <!-- ./box-->
        </div>
        <div class="dataTables_header">
            <div class="dataTables_search">
            <div class="view-search">
                <input
                type="search"
                class="form-control form-control-sm"
                v-model="tableData.search"
                placeholder="Search"
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
            <div class="dataTables_filter">
            <label class="dataTables_length">
                <select class="custom-select" v-model="tableData.length" @change="$emit('getData')">
                <option
                    v-for="(records, index) in perPage"
                    :key="index"
                    :value="records"
                >{{records}}</option>
                </select>
            </label>
            <label class="dataTables_columns custom-select" v-selectcolumnopen>
                <select
                class="custom-select view-columns-filter"
                v-model="tableData.filter.columns"
                v-selectcolumn="tableData.filter.columns"
                multiple="multiple"
                >
                <option
                    v-for="(column, index) in columns"
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
            <label class="dataTables_refresh">
                <button class="btn btn-outline-secondary" @click="$emit('getData')">
                <i class="fas fa-sync-alt"></i>
                </button>
            </label>
            </div>
            <div class="dataTables_buttons">
            <router-link
                tag="button"
                :to="{name: 'create-user'}"
                type="button"
                class="btn btn-outline-secondary"
                v-if="this.$route.name == 'users'"
            >
                Create
                <i class="fa fa-plus fa-fw"></i>
            </router-link>
            </div>
        </div>
        <!-- /.datatables-header -->
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
}
</script>

