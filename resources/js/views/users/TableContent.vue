<style lang="scss">

</style>

<template>
    <tbody>
        <tr
            role="row"
            v-for="(user, index) in dataTable"
            :key="user.id"
            :data-id="user.id"
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
            >{{user.id}}</td>


            <td v-show="tableData.filter.columns.indexOf('name') != -1" class="name"
            >{{user.name | capitalize }}</td>


            <td v-show="tableData.filter.columns.indexOf('email') != -1" class="email"
            ><a :href="'mailto:' + user.email">{{user.email}}</a></td>


            <td v-show="tableData.filter.columns.indexOf('phone') != -1" class="phone"
            >{{user.phone}}</td>


            <td v-show="tableData.filter.columns.indexOf('address') != -1" class="address"
            >{{user.governorate !== null ? user.governorate.governorate_name : ''}}</td>


            <td v-show="tableData.filter.columns.indexOf('photo') != -1" class="photo">
                <img class="avatar-table" :src="user.photo.indexOf('http') === 0 ? user.photo : $domain + '/' + user.photo">
            </td>


            <td v-show="tableData.filter.columns.indexOf('rule') != -1" class="rule">
                <span class="badge badge-success" v-if="user.rule == 1"> {{ $t('users_table.rules.admin') }} </span>
                <span class="badge badge-danger" v-if="user.rule == 2"> {{ $t('users_table.rules.company') }} </span>
                <span class="badge badge-primary" v-if="user.rule == 0"> {{ $t('users_table.rules.user') }} </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('active') != -1" class="active">
                <span class="icon-success" v-if="user.active == 1">
                    <i class="far fa-check-circle"></i>
                </span>
                <span class="icon-danger" v-if="user.active == 0">
                    <i class="far fa-times-circle"></i>
                </span>
            </td>


            <td v-show="tableData.filter.columns.indexOf('created_at') != -1" class="created_at">
                <relative-date :date="user.created_at"></relative-date>
            </td>

            <td v-show="tableData.filter.columns.indexOf('company') != -1" class="company">
                <router-link
                    v-if="user.company !== null"
                    :href="$domain_admin + '/company/profile/' + user.company_id"
                    :to="{name: 'company-profile', params: {id: user.company_id, company: user.company}}"
                    class="link-router-in-table"
                    data-name="company-profile"
                    :data-params='"{\"company\":" + JSON.stringify(user.company) + ", \"id\":" + user.company_id + "}"'
                >
                    {{user.company.name}}
                </router-link>
            </td>


            <td v-show="tableData.filter.columns.indexOf('actions') != -1"
                class="actions"
                >
                <!-- btn edit row -->
                <router-link
                    v-show="user.deleted_at == null"
                    v-if="($gate.isAdminCompany() && $auth.id == user.id) || $gate.isAdmin()"
                    :to="{name: 'edit-user', params: {user: user, id: user.id}}"
                    :href="$domain_admin + '/user/' + user.id + '/edit'"
                    class="btn btn-success btn-edit-row btn-table-actions btn-sm link-router-in-table"
                    data-name="edit-user"
                    :data-params='"{\"user\":" + JSON.stringify(user) + ", \"id\":" + user.id + "}"'
                >
                    <i class="fa fa-edit"></i>
                </router-link>
                <!-- ./ btn edit row -->

                <!-- btn delete row -->
                <a
                    v-if="$gate.isAdmin()"
                    v-show="user.deleted_at == null && user.id != 1"
                    :href="$domain_admin + '/user/destroy'"
                    class="btn btn-danger btn-delete-row btn-table-actions btn-sm"
                    @click.prevent="$emit('destroyRow', user.id)"
                >
                    <i class="fa fa-trash"></i>
                </a>
                <!-- ./ btn delete row -->


                <!-- btn restore row -->
                <a
                    v-if="$gate.isAdmin()"
                    v-show="user.deleted_at != null && user.id != 1"
                    :href="$domain_admin + '/user/restore'"
                    class="btn btn-info btn-restore-row btn-table-actions btn-sm"
                    @click.prevent="$emit('restoreRow', user.id)"
                >
                    <i class="fas fa-undo-alt"></i>
                </a>
                <!-- ./ btn restore row -->

                <!-- btn delete row -->
                <a
                    v-if="$gate.isAdmin()"
                    v-show="user.deleted_at != null && user.id != 1"
                    :href="$domain_admin + '/user/force-delete'"
                    class="btn btn-danger btn-delete-row force-delete btn-table-actions btn-sm"
                    @click.prevent="$emit('forceDeleteRow', user.id)"
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
