<template>
<footer id="footer">
<div class="footer-top">
<div class="container">
</div>
</div>
<div class="container" v-for="elements in foot" :key="elements.id">
<div class="copyright">
&copy; {{elements.Copyright}} <strong>{{elements.name}}</strong>. {{elements.rights}}
</div>
<div class="credits">
<!--
All the links in the footer should remain intact.
You can delete the links only if you purchased the pro version.
Licensing information: https://bootstrapmade.com/license/
Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
-->
{{elements.workby}} <a href="https://bootstrapmade.com/">{{elements.link}}</a>
</div>
</div>
</footer>
</template>

<script>
import axios from 'axios'
 export default{
  name: 'foot',
   data:() =>{
    return{
      foot:[]
    }
    },
     methods: {
        getfoot: function () {
         axios
      .get('http://localhost/officetask/database/footer.php')
      .then(response => {
        this.foot = response.data
      })
      }
    },
    beforeMount() {
      this.getfoot()
    }
}

</script>
