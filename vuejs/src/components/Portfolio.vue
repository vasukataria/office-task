<template>
   <section id="portfolio">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Portfolio</h3>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
        <div class="row">

          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter=".filter-app, .filter-card, .filter-logo, .filter-web" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-logo">Logo</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div>

        <div class="row" id="portfolio-wrapper">
          <div class="col-lg-3 col-md-6 portfolio-item filter-app" v-for="elements in portfolio" :key="elements.id">
            <a href="">
              <img :src="'data:image.png;base64,' + elements.img" alt="">
              <div class="details">
                <h4>{{elements.title}}</h4>
                <span>{{elements.desc}}</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
</template>

<script>
import axios from 'axios'
 export default{
  name: 'portfolio',
   data:() =>{
    return{
      portfolio:[]
    }
    },
     methods: {
        getportfolio: function () {
         axios
      .get('http://localhost/officetask/database/portfolio.php')
      .then(response => {
        this.portfolio = response.data
      })
      }
    },
    beforeMount() {
      this.getportfolio();
    }
}

</script>