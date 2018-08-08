<template lang="pug">
	.quality
		.inner-wrapper
			.content-block
				h3 Якість
				.gallery
					img(:src="require('@/img/sert/1.jpg')")
					img(:src="require('@/img/sert/2.jpg')")
					img(:src="require('@/img/sert/3.jpg')")
					img(:src="require('@/img/sert/4.jpg')")

</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-quality',
		data() {
			return {
				cur: null
			}
		},
		computed: {
			...mapState(['goods'])
		},
		watch: {
			cur() {
				if (this.cur < 0) {
					this.cur = this.goods.length -1
				}
				if (this.cur > this.goods.length -1) {
					this.cur = 0
				}
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/quality.scss"></style>