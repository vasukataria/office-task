<template>
	<div>
		<Adminheader />
	<h5> </h5>
	<router-view />
</div>
</template>
<script>
	import Adminheader from "@/components/Adminheader"
	export default{
		name: 'homepage',
		components:{
			Adminheader,
		},
	}
</script>
<style>
	.h5{
		text-align: center;
		font-size: 90%;
	}


</style>
