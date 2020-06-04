import Vue from 'vue'
import App from './App.vue'
import router from './router'



import './assets/lib/bootstrap/css/bootstrap.min.css'
import './assets/lib/font-awesome/css/font-awesome.min.css'
import './assets/lib/animate/animate.min.css'
import "jquery"
import "bootstrap"
import 'jquery.easing'
import 'jquery.counterup'
import 'superfish'




Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')