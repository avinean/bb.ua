<template lang="pug">
	.slider.inner-wrapper(@mouseenter='pause' @mouseleave='outStart')
		//- i.fas.fa-arrow-left.left.arr(@click='slide(--cur); mode="left"')
		//- i.fas.fa-arrow-right.right.arr(@click='slide(++cur); mode="right"')
		//- .dots
		//- 	.dot(
		//- 		v-for='(dot, i) in items'
		//- 		:class='i == cur ? "dot-cur" : ""'
		//- 		@click='dotSlide(i)'
		//- 	)
		router-link.slide(v-for='(item, i) in items' :key="item" to="/catalog")
			transition(:name='mode')
				.slide-inner(v-show='i == cur' :style="'background-image: url(' + item + ')'")
</template>

<script>
	export default {
		name: 'slider',
		props: ['items', 'auto', 'interval'],
		data() {
			return {
				cur: 0,
				mode: 'right',
				timer: null,
				out: null
			}
		},
		methods: {
			slide(cur) {
				if (cur === this.items.length) this.cur = 0
				else if (cur === -1) this.cur = this.items.length -1
			},
			autoslide() {
				if (this.auto) {
					this.mode = 'right'
					this.slide(++this.cur)
					this.timer = setTimeout(this.autoslide, this.interval)
				}
			},
			outStart() {
				clearTimeout(this.out)
				this.out = setTimeout(this.autoslide, this.interval)
			},
			pause() {
				clearTimeout(this.timer)
			},
			dotSlide(i) {
				if (i === this.cur) return
				else if (i < this.cur) this.mode = 'left'
				else if (i > this.cur) this.mode = 'right'
				this.cur = i
			}
		},
		mounted() {
			this.autoslide()
		}
	}
</script>

<style lang="scss" scoped src="@/scss/components/slider.scss"></style>