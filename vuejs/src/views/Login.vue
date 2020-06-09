<template>
<div id="body">
  <div id="container">
    <div id="header">
        <h2 id="h2">Create Account</h2>
    </div>
    <form id="form" action="" method="post" @submit.prevent="login" enctype='multipart/form-data'>
        <div id="form-control">
            <label for="username">Username</label>
            <input type="text" placeholder="Enter your username" v-model="username" id="username" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-control">
            <label for="password">Password</label>
            <input type="password" placeholder="Password" v-model="password" id="password"/>
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <button type="submit" name="login" id="login_form">Submit</button>
        
    </form>
</div>
</div>
</template>
<script>
export default {
  name: 'Login',
  data () {
    return {
      username: '',
      password: '',
      error: false
    }
  },
  methods: {
    login () {
      console.log(this.username)
      console.log(this.password)
      this.$http.post('', { username: this.username, password: this.password })
    .then(request => {
      console.log(request);
      if(request.status === 200) {
        this.loginSuccessful(request)  
      } else {
        this.loginFailed()  
      }            
    })
    .catch((json) => {  
      this.loginFailed()
    })
    },
    loginSuccessful (req) {
    //  if (!req.data.token) {
    // this.loginFailed()
    // return
    //  }

     // localStorage.token = req.data.token
     this.error = false
     this.$router.replace('/')
     },

    loginFailed () {
    this.error = 'Login failed!'
    delete localStorage.token
    }
  }
}
</script>
