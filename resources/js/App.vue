<template>
  <div dir="ltr" class="my-wrapper-app">
    <transition
      name="custom-classes-transition"
      enter-active-class="animated slideInLeft"
      leave-active-class="animated slideOutRight"
    >
    </transition>
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

  })
}
</script>
