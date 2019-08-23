<style lang="scss">

</style>

<template>
    <tbody>
        <tr
            role="row"
            v-for="(company, index) in dataTable"
            :key="company.id"
            :data-id="company.id"
            class="tr-general"
            :class="index % 2 == 0 ? 'even' : 'odd'"
        >

            <td class="td-show-plus show_plus">
            <span class="btn btn-secondary btn-show-more-row">
                <i class="fa fa-plus"></i>
            </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('index') != -1" class="index"
            >{{index + 1}}</td>


            <td v-show="tableData.filter.columns.indexOf('id') != -1" class="id"
            >{{company.id}}</td>


            <td v-show="tableData.filter.columns.indexOf('name') != -1" class="name"
            >{{company.name | capitalize }}</td>


            <td v-show="tableData.filter.columns.indexOf('email') != -1" class="email"
            ><a :href="'mailto:' + company.email">{{company.email}}</a></td>


            <td v-show="tableData.filter.columns.indexOf('phone') != -1" class="phone"
            >{{company.phone}}</td>


            <td v-show="tableData.filter.columns.indexOf('address') != -1" class="address"
            >{{company.address}}</td>


            <td v-show="tableData.filter.columns.indexOf('website') != -1" class="website"
            ><a target="_blank" :href="company.website">{{company.website}}</a></td>



            <td v-show="tableData.filter.columns.indexOf('description') != -1" class="description"
            >{{company.description}}</td>


            <td v-show="tableData.filter.columns.indexOf('logo') != -1"
                class="logo" style="text-align:center;">
                <img class="avatar-table" :src="$domain + '/' + company.logo">
            </td>


            <td v-show="tableData.filter.columns.indexOf('count_rates') != -1" class="count_rates">
                <rates-stars :rates-count="company.count_rates"></rates-stars> <span style="display: inline-block; position: relative; top: -12px;">( {{ company.rate_user_count }} )</span>
                <div class="text-center" style="font-size: 11px;">{{ company.count_rates }} %</div>
            </td>

            <td v-show="tableData.filter.columns.indexOf('visits') != -1" class="visits"
            >{{company.visits}}</td>

            <td v-show="tableData.filter.columns.indexOf('location') != -1" class="location"
            >
                <button
                    v-if="company.longitude != null && company.latitude != null"
                    class="btn btn-outline-secondary btn-sm"
                    id="show_map_location"
                    :data-long="company.longitude"
                    :data-lat="company.latitude"
                    :data-location-title="company.name"
                >Show map</button>
                <span v-else>No location</span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('face_link') != -1" class="face_link"
            ><a target="_blank" :href="company.face_link">{{company.face_link}}</a></td>


            <td v-show="tableData.filter.columns.indexOf('tw_link') != -1" class="tw_link"
            ><a target="_blank" :href="company.tw_link">{{company.tw_link}}</a></td>


            <td v-show="tableData.filter.columns.indexOf('display') != -1" class="display">
                <span class="icon-info" v-if="company.display == 1">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="icon-warning" v-if="company.display == 0">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('active') != -1" class="active">
                <span class="icon-success" v-if="company.active == 1">
                    <i class="far fa-check-circle"></i>
                </span>
                <span class="icon-danger" v-if="company.active == 0">
                    <i class="far fa-times-circle"></i>
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('created_at') != -1" class="created_at">
                <relative-date :date="company.created_at"></relative-date>
            </td>


            <td v-show="tableData.filter.columns.indexOf('actions') != -1"
                class="actions"
                >
                <!-- show company profile -->
                <router-link
                    v-show="company.deleted_at == null"
                    :to="{name: 'company-profile', params: {company: company, id: company.id}}"
                    :href="$domain_admin + '/company/profile/' + company.id"
                    class="btn btn-info btn-show-profile btn-table-actions btn-sm link-router-in-table"
                    data-name="company-profile"
                    :data-params='"{\"company\":" + JSON.stringify(company) + ", \"id\":" + company.id + "}"'

                >
                    <i class="fas fa-eye"></i>
                </router-link>

                <!-- btn edit row -->
                <router-link
                    v-show="company.deleted_at == null"
                    :to="{name: 'edit-company', params: {company: company, id: company.id}}"
                    :href="$domain_admin + '/company/' + company.id + '/edit'"
                    class="btn btn-success btn-edit-row btn-table-actions btn-sm link-router-in-table"
                    data-name="edit-company"
                    :data-params='"{\"company\":" + JSON.stringify(company) + ", \"id\":" + company.id + "}"'
                >
                    <i class="fa fa-edit"></i>
                </router-link>
                <!-- ./btn edit row -->

                <!-- btn delete row -->
                <a
                    v-show="company.deleted_at == null"
                    :href="$domain_admin + '/company/destroy'"
                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm"
                    @click.prevent="$emit('destroyRow', company.id)"
                >
                    <i class="fa fa-trash"></i>
                </a>
                <!-- ./ btn delete row -->


                <!-- btn restore row -->
                <a
                    v-show="company.deleted_at != null"
                    :href="$domain_admin + '/company/restore'"
                    class="btn btn-info btn-restore-row btn-table-actions btn-sm"
                    @click.prevent="$emit('restoreRow', company.id)"
                >
                    <i class="fas fa-undo-alt"></i>
                </a>
                <!-- ./ btn restore row -->

                <!-- btn delete row -->
                <a
                    v-show="company.deleted_at != null"
                    :href="$domain_admin + '/company/force-delete'"
                    class="btn btn-danger btn-delete-row force-delete btn-table-actions btn-sm"
                    @click.prevent="$emit('forceDeleteRow', company.id)"
                >
                    <i class="far fa-trash-alt"></i>
                </a>
                <!-- ./ btn delete row -->




            </td>
        </tr>
    </tbody>
</template>




<script>
export default {
    props: [
        'dataTable',
        'tableData',
    ]
}
</script>
