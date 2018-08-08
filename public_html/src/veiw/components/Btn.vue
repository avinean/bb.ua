<template lang="pug">
	.btn.bg-sky(@click='click' :class='"btn-" + sz')
		slot
</template>

<script>
	export default {
		name: 'btn',
		props: ['size'],
		computed: {
			sz() {return this.size || 'lg'}
		},
		methods: {
			click() {
				this.$emit('click')
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/components/btn.scss"></style>