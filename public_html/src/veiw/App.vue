<template lang="pug">
	#app
		page-header(view='narrow')
		.main-block
			router-view
		callback
		up
		page-footer
		.result-message(v-if='showMessage' v-html='showMessage')
</template>

<script>
	export default {
		name: 'App'
	}
</script>

<style lang="scss" src="@/scss/app.scss"></style>