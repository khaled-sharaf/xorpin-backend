// const domain = 'http://localhost:8000'
const domain = window.url

require('./bootstrap');

window.Vue = require('vue');


import App from './App.vue'
import router from './router'


import './plugins/select2/select2.min.css'
import './plugins/select2/select2.min.js'
import './components.js'

/**************************************************************************************/

Vue.config.productionTip = false

/**************************************************************************************/

import Gate from './Gate'
Vue.prototype.$domain = domain
Vue.prototype.$gate = new Gate(window.user)

/**************************************************************************************/

// axios -- for request ajax
import axios from 'axios'
window.axios = axios
// axios.defaults.baseURL = apiDomain
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

import VueProgressBar from "vue-progressbar";
Vue.use(VueProgressBar, {
    color: "#2ecc71",
    failedColor: "#e3342f",
    height: "4px"
});

const calculatePercentage = (loaded, total) => (Math.floor(loaded * 1.0) / total)
const setupUpdateProgress = ($progress) => {
    axios.defaults.onDownloadProgress = e => {
        const percentage = calculatePercentage(e.loaded, e.total)
        // NProgress.set(percentage)
        $progress.set(percentage)
    }
}
const setupStopProgress = ($progress) => {
    axios.interceptors.response.use(response => {
        $progress.finish();
        // $progress.done(true); // NProgress
        return response
    })
}
export function loadReq($progress) {
    // $progress.configure(config) // NProgress
    $progress.start()
    setupUpdateProgress($progress)
    setupStopProgress($progress)
}
window.loadReq = loadReq;

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
