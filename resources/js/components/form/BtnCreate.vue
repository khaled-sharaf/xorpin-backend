<template>
    <button
        type="submit"
        :disabled="form.busy"
        class="btn btn-primary float-right">
        {{ $t('global.create') }}
        <span v-if="form.busy" class="btn-loader"><img :src="$domain + '/admin/images/btn-loader.gif'"></span>
    </button>
</template>


<script>
    export default {
        props: ['form']
    }
</script>

