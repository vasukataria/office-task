<template>
<div id="body">
  <div id="container">
   
    <form id="form" action="" method="post" @submit.prevent="login" enctype='multipart/form-data'>
        <div id="form-signin">
          <h2 id="h2">login</h2><br>
            <label for="username">Username</label>
            <input type="text" placeholder="Enter your username" id="username" name="uName" v-model="uName" />
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
        <button type="submit" name="login" id="login_form">Submit</button>
        <p>create new account...??<router-link to=/signup>signup</router-link></p>
    </form>
</div>
</div>
</template>
<script>
export default {
  name: 'login',
  data () {
    return {
      uName: "",
      pass: "",
      error: false
    }
  },
  mounted(){
   this.login();  
//var self= this;
const form = document.getElementById('form');
const username = document.getElementById('username');
const password = document.getElementById('password');

form.addEventListener('submit', e => {
    e.preventDefault();
    checkInputs();

   

});

function checkInputs() {
    // trim to remove the whitespaces
    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();
    
    if(usernameValue === '') {
        setErrorFor(username, 'Username cannot be blank');
    } else {
        setSuccessFor(username);
    }
    
    if(passwordValue === '') {
        setErrorFor(password, 'Password cannot be blank');
    } else {
        setSuccessFor(password);
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
      },
  created () {
  this.checkCurrentLogin()
  },
  methods: {
  checkCurrentLogin () {
    if (localStorage.token) {
      if (localStorage.user==="Admin"){
        this.$router.replace('/AdminHomepage')
      }
      else{
        this.$router.replace('/')
      }
    }
  },
    login () {
      this.$http.post('/login.php', { uName: this.uName, pass: this.pass })
    .then(request => {
      if(request.status === 200) {
        this.loginSuccessful(request)  
      } else {
        this.loginFailed()  
      }            
    })
    .catch(() => {  
      this.loginFailed()
    })
    },
    loginSuccessful(req) {
      //console.log(!req.data.token); 
      if (req.data.token == null) {
        this.loginFailed()
        return
      }

     localStorage.token = req.data.token
     localStorage.user  = req.data.user
     
     if(localStorage.user == "Admin")
     {
      //this.error = false
     this.$router.replace('/AdminHomepage')
     }else{
      this.$router.replace('/')
      console.log(localStorage)
     }
     },

    loginFailed () {
    this.error = 'Login failed!'
    //delete localStorage.token
    },
  }
}
</script>
