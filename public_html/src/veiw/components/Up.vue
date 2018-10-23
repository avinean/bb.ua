<template lang="pug">
	.up(@click='up')
		i.dust.fas.fa-chevron-circle-up
</template>

<script>
	export default {
		name: 'up',
		methods: {
			up() {
				window.scrollTo({
					top: 0,
					behavior: "smooth"
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.up {
		position: fixed;
		z-index: 9999;
		bottom: 50px;
		left: 10px;
		font-size: 70px;
		cursor: pointer;
	}
</style>