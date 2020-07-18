<template>
	<div>
		<Adminheader />
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


</style>
