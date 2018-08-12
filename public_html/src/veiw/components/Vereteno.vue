<template lang="pug">
	.vereteno
		i.fas.fa-chevron-circle-left.left.arr(@click='slide(0)')
		i.fas.fa-chevron-circle-right.right.arr(@click='slide(1)')
		.item(v-for='item in cur')
			img(:src='require("@/img/products/" + items[item].img)')
			.title {{items[item].title}}
			a.btn(:href='"/catalog/" + items[item].cat + "/" + items[item].id') Детальніше
</template>

<script>
	export default {
		name: 'vereteno',
		props: ['items'],
		data() {
			return {
				cur: [0,1,2,3]
			}
		},
		methods: {
			slide(d) {
				
				if (d) {
					this.cur = this.cur.map(e => {
						e++;
						if (e > this.items.length - 1) return 0;
						return e;
					})
				}
				if (!d) {
					this.cur = this.cur.map(e => {
						e--;
						if (e < 0) return this.items.length - 1;
						return e
					})
				}
			}
		},
		mounted() {
		}
	}
</script>

<style lang="scss" scoped src="@/scss/components/vereteno.scss"></style>