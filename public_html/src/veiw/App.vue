<template lang="pug">
	#app
		page-header(view='narrow')
		.main-block
			router-view
		up
		page-footer
</template>

<script>
	export default {
		name: 'App'
	}
</script>

<style lang="scss" src="@/scss/app.scss"></style>
