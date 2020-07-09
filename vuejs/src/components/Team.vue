<template>
	<section id="team">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Team</h3>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
        <div class="row" >
          <div class="col-lg-3 col-md-6" v-for="elements in team" :key="elements.id">
            <div class="member">
              <div class="pic"><img :src="'data:image.png;base64,' + elements.img" alt=""></div>
              <h4>{{elements.title}}</h4>
              <span>{{elements.desc}}</span>
              <div class="social">
                <router-link :to="elements.facebookLink"><i class="fa fa-twitter"></i></router-link>
                <router-link :to="elements.twitterLink"><i class="fa fa-facebook"></i></router-link>
                <router-link :to="elements.googleLink"><i class="fa fa-google-plus"></i></router-link>
                <router-link :to="elements.linkedinLink"><i class="fa fa-linkedin"></i></router-link>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
</template>
<script>
import axios from 'axios'
 export default{
  name: 'team',
   data:() =>{
    return{
      team:[]
    }
    },
     methods: {
        getaction: function () {
         axios
      .get('http://localhost/officetask/database/team.php')
      .then(response => {
        this.team = response.data
      })
      }
    },
    beforeMount() {
      this.getaction()
    }
}

</script>