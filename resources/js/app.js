
require('./bootstrap');

window.Vue = require('vue');


import App from './App.vue'
import router from './router'
import axios from 'axios'
import jQuery from 'jquery'

window.axios = axios

Vue.config.productionTip = false


new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
