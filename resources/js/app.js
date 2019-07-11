// const domain = 'http://localhost:8000'

require('./bootstrap');

window.Vue = require('vue');


import App from './App.vue'
import router from './router'


import './plugins/select2/select2.min.css'
import './plugins/select2/select2.min.js'
import './plugins/progressBar.js'
import './components.js'
import './filters.js'
import './directives.js'

/**************************************************************************************/

Vue.config.productionTip = false

/**************************************************************************************/


// global properties

import Gate from './Gate'
Vue.prototype.$domain = window.url
Vue.prototype.$domain_admin = window.url + '/' + window.cp_prefix
Vue.prototype.$gate = new Gate(window.auth)


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

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;

/**************************************************************************************/
import DatePicker from 'vue2-datepicker';
Vue.component(DatePicker.name, DatePicker);

/**************************************************************************************/


new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
