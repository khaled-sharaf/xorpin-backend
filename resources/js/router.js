import Vue from 'vue'
import Router from 'vue-router'
import Test from './views/Test.vue'
import Home from './views/Home.vue'


Vue.use(Router)

const vueRouter = new Router({
  mode: 'history',
  base: '/admin',
  routes: [
    {
      path: '/dashboard',
      name: 'home',
      component: Home
    },
    {
      path: '/test',
      name: 'test',
      component: Test
    },
    // {
    //   path: '*',
    //   component: Page404
    // }
  ]
})

export default vueRouter
