<template lang="pug">
	.gallery
		.inner-wrapper
			.content-block
				h3 Галерея
				.lib
					img.gallery-item(
						v-for='(good, i) in goods'
						:src="require('@/img/products/' + good.img)"
						:alt='good.desc'
						@click='cur = i'
					)
		.screen(v-if='cur !== null')
			i.fas.fa-arrow-left.left.arr(@click='cur--')
			i.fas.fa-arrow-right.right.arr(@click='cur++')
			i.fas.fa-times.close(@click='cur = null')
			img(:src="require('@/img/products/' + (cur+1) + '.jpg')")
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-catalog',
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

<style lang="scss" scoped src="@/scss/pages/gallery.scss"></style>