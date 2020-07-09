<template>
<section id="hero">
    <div class="hero-container" v-for="element in hero" :key="element.id" >
      <h1>{{ element.title }}</h1>
      <h2>{{ element.desc }}</h2>
      <a href="#about" class="btn-get-started">{{ element.buttonName }}</a>
    </div>
  </section>
</template>
<script>
import axios from 'axios'
 export default{
  name: 'hero',
   data:() =>{
    return{
      hero:[]
    }
    },
     methods: {
        gethero: function () {
         axios
      .get('http://localhost/officetask/database/hero.php')
      .then(response => {
        this.hero = response.data
      })
      }
    },
    beforeMount() {
      this.gethero()
    }
}

</script>