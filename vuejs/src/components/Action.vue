<template>
	<section id="call-to-action">
      <div class="container wow fadeIn" v-for="elements in action" :key="elements.id">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">{{elements.title}}</h3>
            <p class="cta-text">{{elements.desc}}</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <router-link class="cta-btn align-middle" to="#">{{elements.buttonName}}</router-link>
          </div>
        </div>

      </div>
    </section>
</template>
<script>
import axios from 'axios'
 export default{
  name: 'action',
   data:() =>{
    return{
      action:[]
    }
    },
     methods: {
        getaction: function () {
         axios
      .get('http://localhost/officetask/database/action.php')
      .then(response => {
        this.action = response.data
      })
      }
    },
    beforeMount() {
      this.getaction()
    }
}

</script>