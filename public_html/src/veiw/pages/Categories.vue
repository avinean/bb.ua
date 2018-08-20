<template lang="pug">
	.categories
		.inner-wrapper
			.content-block
				.divide-head {{categories[category]}}
				.vereteno-inner(v-if='goods')
					.item(v-for='item in goods')
						img(:src='require("@/img" + item.img)')
						.title {{item.title}}
						router-link.btn(:to='"/catalog/" + item.category + "/" + item.id') Детальніше
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-categories',
		data() {
			return {
				categories: {
					'pave': 'Тротуарні елементи',
					'road': 'Дорожні елементи',
					'vert': 'Вертикальні елементи'
				},
				goods: null
			}
		},
		computed: {
			category() {
				return this.$route.params.category
			}
		},
		methods: {
			async loadGoodsList() {
				let res = await this.request({
					method: 'get',
					className: 'Catalog',
					methodName: 'getGoods',
					opts: {
						where: [
							{
								type: 's',
								comp: '=',
								val: this.category,
								field: 'category'
							},
							{
								type: 'i',
								comp: '>',
								val: '0',
								field: 'id'
							}
						]
					}
				})
				this.goods = res.data;
				
			}
		},
		mounted() {
			this.loadGoodsList()
		},
		watch: {
			category() {
				this.loadGoodsList()
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/categories.scss"></style>