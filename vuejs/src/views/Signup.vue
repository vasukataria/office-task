<template>
<div id="body">
  <div id="container">
    <div id="header">
    <button><router-link to="/login">login</router-link></button>    
    </div>
    <form id="form" method="post" role="signupForm" class="signupForm" @submit="userForm" action="" enctype='multipart/form-data'>
        <h2 id="h2">Create Account</h2>
        <br>
        <div id="form-signin">
            <label for="username">Username</label>
            <input type="text" placeholder="Enter your username" id="username" name="uName" v-model="uName" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="email">Email</label>
            <input type="email" placeholder="info@example.com" id="email" name="email" v-model="email" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password" name="pass"  v-model="pass" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="username">Password check</label>
            <input type="password" placeholder="Password two" id="password2"/>
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
</div>

</template>
<style>
@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap');

@import './signup.css';

</style>
<script>
// import axios from 'axios'
import Vue from 'vue'
export default {
  name: 'Signup',
  data(){
    return{
      uName: null,
      email: null,
      pass: null,

    }
  },
  
mounted(){
   this.userForm();  
//var self= this;
const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

form.addEventListener('submit', e => {
    e.preventDefault();
    checkInputs();
   // console.log('hello');
   // self.getAllMembers();
   

});

function checkInputs() {
    // trim to remove the whitespaces
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    
    if(usernameValue === '') {
        setErrorFor(username, 'Username cannot be blank');
    } else {
        setSuccessFor(username);
    }
    
    if(emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Not a valid email');
    } else {
        setSuccessFor(email);
    }
    
    if(passwordValue === '') {
        setErrorFor(password, 'Password cannot be blank');
    } else {
        setSuccessFor(password);
    }
    
    if(password2Value === '') {
        setErrorFor(password2, 'Password2 cannot be blank');
    } else if(passwordValue !== password2Value) {
        setErrorFor(password2, 'Passwords does not match');
    } else{
        setSuccessFor(password2);
    }

}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'form-signin error';
    small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-signin success';
}
    
function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);}//eslint-disable-line      
      },


methods:{
  userForm:function () {
    if (this.uName && this.email && this.pass) {
        fetch("http://localhost/officetask/database/user.php",{
            method: "POST", 
            body: JSON.stringify({
                      uName : this.uName,
                      email : this.email,
                      pass : this.pass,
                    }),
          }).then(request => { 
            console.log(request);
            request.text().then((message) => {
                if(request.status === 409){
                    Vue.$toast.open(message);

                    this.userValidation()
                    //console.log('hello');
                } else if (request.status === 200){
                this.signupSuccessful()
                }else{
                    this.signupFailed()
                } 
            })
                 
        })
      .catch(() => {  
      this.signupFailed()
    })
    }
},
signupSuccessful(){
     this.error = false
     this.$router.replace('/login')

},
signupFailed(){
    this.error='Login failed!'
},
userValidation(){
    this.error=''
}
}
}


</script>