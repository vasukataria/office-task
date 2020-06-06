<template>
<div id="body">
  <div id="container">
	<div id="header">
		<h2 id="h2">Login</h2>
	</div>
	<form id="form1">
		<div id="form-control1">
			<label for="username">Username</label>
			<input type="text" placeholder="Enter your username" id="username" />
			<i id="fas fa-check-circle"></i>
			<i id="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
		<div id="form-control1">
			<label for="username">Password</label>
			<input type="password" placeholder="Password" id="password"/>
			<i id="fas fa-check-circle"></i>
			<i id="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
		<button>Login</button>
	</form>
</div>
</div>

</template>
<style>
@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap');

@import 'signup.css';

</style>
<script>
export default {
  name: 'Login',
  data(){
    return{

    }
  },
  mounted(){

const form1 = document.getElementById('form1');
const username = document.getElementById('username');
const password = document.getElementById('password');

form1.addEventListener('Login', e => {
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
	const formControl1 = input.parentElement;
	const small = formControl1.querySelector('small');
	formControl1.className = 'form-control1 error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl1 = input.parentElement;
	formControl1.className = 'form-control1 success';
}

  }
}



</script>