<template>
  <!-- <div class="my-wrapper-app" :dir="$i18n.locale == 'ar' ? 'rtl' : 'ltr'"> -->
  <div class="my-wrapper-app">
      <router-view class="general-router-view"></router-view>
  </div>
</template>



<style lang="scss">

</style>

<script>
export default {
  name: 'App',
  components: {

  },
  data: () => ({

  }),
  mounted() {
  },
}
</script>
