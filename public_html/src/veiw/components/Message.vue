<template lang="pug">
	.message(:class='"bg-" + bg' v-html='msg')
</template>

<script>
	export default {
		name: 'message',
		props: ['msg', 'bg'],
	}
</script>

<style lang="scss" scoped>
	.message {
		position: fixed;
		z-index: 999;
		bottom: 0;
		left: 0;
		top: 0;
		right: 0;
		margin: auto;
		height: 150px;
		width: 300px;
		color: white;
		text-align: center;
		display: flex;
		align-items: center;
		padding: 10px;
	}
</style>