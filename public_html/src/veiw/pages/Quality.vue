<template lang="pug">
	.quality
		.inner-wrapper
			callback(simple='1' key='123')

</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-quality',
	}
</script>

<style lang="scss" scoped src="@/scss/pages/quality.scss"></style>