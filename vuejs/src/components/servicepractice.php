<template>
	<section id="services">
      <div class="container wow fadeIn">
        <div class="section-header">
          <h3 class="section-title">Services</h3>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="box" v-for="elements in services" :key="elements">
              <div class="icon"><a href=""><i :class="elements.class"></i></a></div>
              <h4 class="title"><a href="">{{elements.title}}</a></h4>
              <p class="description">{{elements.desc}}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
</template>
<script>
import axios from 'axios'
 export default{
  name: 'services',
   data:() =>{
    return{
      services:[]
    }
    },
     methods: {
        getservices: function () {
         axios
      .get('http://localhost/officetask/database/service.php')
      .then(response => {
        this.services = response.data
      })
      }
    },
    beforeMount() {
      this.getservices()
    }
}

</script>
