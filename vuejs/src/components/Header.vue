<template>
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="../assets/img/logo.png" alt="" title="" /></a>
        <!-- Uncomment below if you prefer to use a text logo -->
        <!--<h1><a href="#hero">Regna</a></h1> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li v-for="element in practice" :key="element">
            <router-link :to="element.link">{{element.name}}</router-link>
          </li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
     </header>
</template>
<script>
import axios from 'axios'
 export default{
  name: 'Practice',
   data:() =>{
    return{
      practice:[]
    }
    },
    mounted(){
      this.getPractice()
    },
     methods: {
        getPractice: function () {
         axios
      .get('http://localhost/officetask/database/header.php')
      .then(response => {
        this.practice = response.data
      })
      }
    },
}

</script>