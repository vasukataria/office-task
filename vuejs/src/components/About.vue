<template>
<section id="about">
<div class="container">
<div class="row about-container">

<div class="col-lg-6 content order-lg-1 order-2" v-for="elements in about" :key="elements">
<h2 class="title">{{elements.parentTitle}}</h2>
<p>
{{elements.parentDesc}}
</p>

<div class="icon-box wow fadeInUp">
<div class="icon"><i class="fa fa-shopping-bag"></i></div>
<h4 class="title"><a href="">{{elements.ChildTitle}}</a></h4>
<p class="description">{{elements.ChildDesc}}</p>
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










	

