<template>
	<div></div>
</template>
<script>
	import axios from "axios"
	export default{
		name:"logout",
		methods:{
	logout() {
                axios.post('http://localhost/officetask/database/logout.php').then(response => {
                    if (response.status === 401) {
                        console.log('logout')
                    }
                })
                localStorage.removeItem('token')
                this.$router.push('/')
              }
          },
          beforeMount(){
            this.logout();
          },
    }
</script>