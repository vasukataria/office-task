<template>
  <section id="facts">
      <div class="container wow fadeIn" v-for="elements in Facts" :key="elements.id">
        <div class="section-header">
          <h3 class="section-title">{{elements.title}}</h3>
          <p class="section-description">{{elements.desc}}</p>
        </div>
        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{elements.Clients}}</span>
            <p>Clients</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{elements.Projects}}</span>
            <p>Projects</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{elements.HoursOfSupport}}</span>
            <p>Hours Of Support</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{elements.HardWorkers}}</span>
            <p>Hard Workers</p>
          </div>

        </div>

      </div>
    </section>
</template>
<script>
import axios from 'axios'
 export default{
  name: 'fact',
   data:() =>{
    return{
      Facts:[]
    }
    },
     methods: {
        getFacts: function () {
         axios
      .get('http://localhost/officetask/database/fact.php')
      .then(response => {
        this.Facts = response.data
      })
      }
    },
    beforeMount() {
      this.getFacts()
    }
}

</script>