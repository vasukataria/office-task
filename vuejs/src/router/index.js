import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Signup from '../views/Signup.vue'
import Login from '../views/Login.vue'
import Admin from '../views/Admin.vue'
import AdminHeader from '../views/AdminHeader.vue'
import Adminfooter from '../views/Adminfooter.vue'
import Adminabout from '../views/Adminabout.vue'
import Adminaction from '../views/Adminaction.vue'
import AdminFact from '../views/AdminFact.vue'
import AdminHero from '../views/AdminHero.vue'
import AdminServices from '../views/AdminServices.vue'
import AdminPortfolio from '../views/AdminPortfolio.vue'
import AdminTeam from '../views/AdminTeam.vue'
import AdminHomepage from '../views/AdminHomepage'
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
    path: '/AdminHomepage',
    name: 'Homepage',
    component: AdminHomepage,
    beforeEnter(to,from,next){
    let currentUser =JSON.parse(window.localstorage.currentUser);
    if(currentUser && currentUser.username){
      next();
    }else{
      next("/Login")
    }

  },  
    children:[
    {
    path: '/Admin',
    name: 'Admin',
    component: Admin
    },
    {
    path: '/AdminHeader',
    name: '/AdminHeader',
    component: AdminHeader
    },

    {
    path: '/Adminfooter',
    name: 'Adminfooter',
    component: Adminfooter
    },
    {
    path: '/Adminabout',
    name: 'Adminabout',
    component: Adminabout
    },
    {
    path: '/Adminaction',
    name: 'Adminaction',
    component: Adminaction
    },
      {
    path: '/AdminFact',
    name: 'AdminFact',
    component: AdminFact
  },
  {
    path: '/AdminHero',
    name: 'AdminHero',
    component: AdminHero
  },
  {
    path: '/AdminServices',
    name: 'AdminServices',
    component: AdminServices
  },
  {
    path: '/AdminPortfolio',
    name: 'AdminPortfolio',
    component: AdminPortfolio
  },
    {
    path: '/AdminTeam',
    name: 'AdminTeam',
    component: AdminTeam
  },
    ]
  },
  ]
const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
