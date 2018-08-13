<template lang="pug">
	.up(@click='up')
		i.fas.fa-chevron-circle-up
</template>

<script>
	export default {
		name: 'up',
		methods: {
			up() {
				window.scrollTo(0, 0)
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