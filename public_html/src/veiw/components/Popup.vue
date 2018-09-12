<template lang="pug">
	.popup
		.popup-bg(@click='close')
		.popup-wrap
			.head
				.title
					slot(name='head') Info
				i.fas.fa-times.close(@click='close')
			.body
				slot(name='body')
			.foot
				slot(name='foot')
</template>

<script>
	export default {
		name: 'popup',
		methods: {
			close() {
				this.$emit('close');
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/components/popup.scss"></style>