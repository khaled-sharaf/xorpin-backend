// const domain = 'http://localhost:8000'

require('./bootstrap');

window.Vue = require('vue');

Vue.config.productionTip = false

// global properties

Vue.prototype.$domain = window.url
Vue.prototype.$auth = window.auth
Vue.prototype.$authCompany = window.authCompany
Vue.prototype.$settings = window.settings
Vue.prototype.$domain_admin = window.url + '/' + window.cp_prefix
import Gate from './Gate'
Vue.prototype.$gate = new Gate()

/**************************************************************************************/


import i18n from './plugins/i18n' // localization
import App from './App.vue'
import router from './router'

/**************************************************************************************/

// adminlte v3



// select 2
import './plugins/select2/select2.min.css'
import './plugins/select2/select2.min.js'

import './plugins/progressBar.js'
import './components.js'
import './filters.js'
import './directives.js'

/**************************************************************************************/


// axios -- for request ajax
import axios from 'axios'
window.axios = axios
axios.defaults.baseURL = window.url + '/' + window.cp_prefix

/**************************************************************************************/

import moment from "moment";
Vue.prototype.moment = moment;

/**************************************************************************************/

import { Form, HasError, AlertError, AlertErrors, AlertSuccess } from "vform";
window.Form = Form;
// vue form
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);

/**************************************************************************************/



import Swal from "sweetalert2";
window.Swal = Swal;

const ToastReq = Swal.mixin({
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
    type: "success",
});
window.ToastReq = ToastReq;

/**************************************************************************************/
import DatePicker from 'vue2-datepicker';
Vue.component(DatePicker.name, DatePicker);

/**************************************************************************************/


const app = new Vue({
  i18n,
  router,
  render: h => h(App)
}).$mount('#app')

