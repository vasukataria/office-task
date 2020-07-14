<template>
<div id="body">
  <div id="container">
    <div id="header">
        <h2 id="h2"></h2>
    </div>
    <form id="form" action="" method="post" @submit.prevent="login" enctype='multipart/form-data'>
        <div id="form-signin">
          <h2 id="h2">login</h2><br>
            <label for="username">Username</label>
            <input type="text" placeholder="Enter your username" v-model="username" id="username" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="password">Password</label>
            <input type="password" placeholder="Password" v-model="password" id="password"/>
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
      username: '',
      password: '',
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
  updated () {
  this.checkCurrentLogin()
  },
  methods: {
  checkCurrentLogin () {
    if (localStorage.token) {
      this.$router.replace('/Admin')
    }
  },
    login () {
      this.$http.post('/login.php', { username: this.username, password: this.password })
    .then(request => {
      console.log(request);
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
      if (!req.data.token) {
        this.loginFailed()
        return
      }

     localStorage.token = req.data.token
     this.error = false
     this.$router.replace('/Admin')
     },

    loginFailed () {
    this.error = 'Login failed!'
    delete localStorage.token
    },
    updated () {
    if (localStorage.token) {
    this.$router.replace('/Admin')
  }
},
  created () {
  if (localStorage.token) {
    this.$router.replace('/Admin')
  }
},
  }
}
</script>
