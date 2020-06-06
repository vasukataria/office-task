<template>
<div id="body">
  <div id="container">
	<div id="header">
		<h2 id="h2">Login</h2>
	</div>
	<form id="form">
		
		<div id="form-control">
			<label for="username">Email</label>
			<input type="email" placeholder="info@example.com" id="email" />
			<i id="fas fa-check-circle"></i>
			<i id="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
		<div id="form-control">
			<label for="username">Password</label>
			<input type="password" placeholder="Password" id="password"/>
			<i id="fas fa-check-circle"></i>
			<i id="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
		<button>Submit</button>
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
  name: 'Signup',
  data(){
    return{

    }
  },
  mounted(){

const form = document.getElementById('form');
const email = document.getElementById('email');
const password = document.getElementById('password');

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
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
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);}//eslint-disable-line


  }
}



</script>