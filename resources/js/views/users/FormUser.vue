<style>


</style>

<template>
    <div>
        <form>
            Form User {{ type }}
        </form>
    </div>
</template>


<script>
    export default {
        props: ['type'],
        mounted() {
            document.title = 'Dashboard Test'
        }
    }
</script>
