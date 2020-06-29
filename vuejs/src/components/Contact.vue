<template>
     <section id="contact">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Contact</h3>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
      </div>

      <!-- Uncomment below if you wan to use dynamic maps -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

      <div class="container wow fadeInUp mt-5">
        <div class="row justify-content-center">

          <div class="col-lg-3 col-md-4">

            <div class="info">
              <div>
                <i class="fa fa-map-marker"></i>
                <p>A108 Adam Street<br>New York, NY 535022</p>
              </div>

              <div>
                <i class="fa fa-envelope"></i>
                <p>info@example.com</p>
              </div>

              <div>
                <i class="fa fa-phone"></i>
                <p>+1 5589 55488 55s</p>
              </div>
            </div>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-5 col-md-8">
            <div class="form">
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <form method="post" role="form" class="contactForm" @submit="checkForm" action="" enctype='multipart/form-data'>
                <p v-if="errors.length">
                  <b>Please correct the following error(s):</b>
                  <ul>
                    <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                  </ul>
                </p>

                <div class="form-group">
                  <input type="text" name="name" v-model="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4"  data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" v-model="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" v-model="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" v-model="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit" name="submit" >Send Message</button></div>
              </form>
            </div>
          </div>

        </div>

      </div>
    </section>
</template>

<script>
//import jQuery from "jquery"
import axios from "axios" //eslint-disable-line

export default {
  name: 'Home',
  data(){
    return {
      errors: [],
      name: null,
      email: null,
      subject: null,
      message: null,
    }
  },
  methods:{
    checkForm: function (e) {
      e.preventDefault();
      
      if (this.name && this.email && this.subject && this.message) {
        axios(
          { 
            method: "POST", 
            "url": "http://localhost/officetask/database/", 
            "data": {
                      name : this.name,
                      email : this.email,
                      subject : this.subject,
                      message : this.message,
                    }, 
          }).then(result => {
              console.log(result.data);
              this.response = result.data;
          }, error => {
              console.error(error);
          });
      }

      this.errors = [];

      if (!this.name) {
        this.errors.push('Name required.');
      }
      if (!this.email) {
        this.errors.push('Email required.');
      }
      if (!this.subject) {
        this.errors.push('Subject required.');
      }
      if (!this.message) {
        this.errors.push('Message required.');
      }
    }
  },
  }
</script>