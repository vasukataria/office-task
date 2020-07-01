import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueMaterial from 'vue-material'
import VueAxios from 'vue-axios'
import VueToast from 'vue-toast-notification';
//import Vue from 'vue'





import './assets/lib/bootstrap/css/bootstrap.min.css'
import './assets/lib/font-awesome/css/font-awesome.min.css'
import './assets/lib/animate/animate.min.css'
import 'vue-toast-notification/dist/theme-default.css';
import "jquery"
import "bootstrap"
import 'jquery.easing'
import 'jquery.counterup'
import 'superfish'



import axios from'./backend/axios'

Vue.use(VueToast, {
  // One of options
  position: 'top-right',
  duration: 20000,
  height: 55
})
Vue.use(VueAxios, axios)
Vue.use(VueMaterial)
Vue.config.productionTip = false

new Vue({
  router,
  axios,
  render: h => h(App)
}).$mount('#app')

