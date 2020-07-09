<template>
<section id="about">
<div class="container">
<div class="row about-container">
	
<div class="col-lg-6 content order-lg-1 order-2" >
<h2 class="title">Few Words About </h2>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
</p>
<div v-for="row in about" :key="row.id">
<div class="icon-box wow fadeInUp">
<div class="icon"><i :class="row.class"></i></div>
<h4 class="title"><a href="">{{row.ChildTitle}}</a></h4>
<p class="description">{{row.ChildDesc}}</p>
</div>

</div>
</div>

<div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight"></div>
</div>

</div>
</section>
</template>

<script>
import axios from 'axios'
 export default{
  name: 'about',
   data:() =>{
    return{
      about:[]
    }
    },
     methods: {
        getabout: function () {
         axios
      .get('http://localhost/officetask/database/about.php')
      .then(response => {
        this.about = response.data
      })
      }
    },
    beforeMount() {
      this.getabout()
    }
}

</script>