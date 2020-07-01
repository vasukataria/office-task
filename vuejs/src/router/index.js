import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Signup from '../views/Signup.vue'
import Login from '../views/Login.vue'
import Admin from '../views/Admin.vue'
import Adminheader from '../views/Adminheader.vue'
import Header from '../views/Header.vue'
Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/Signup',
    name: 'Signup',
    component: Signup
  },
  {
    path: '/Login',
    name: 'Login',
    component: Login
  },
   {
    path: '/Admin',
    name: 'Admin',
    component: Admin
  },
     {
    path: '/Adminheader',
    name: 'Adminheaders',
    component: Adminheader
  },
  {
    path: '/Header',
    name: 'Header',
    component: Header
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
