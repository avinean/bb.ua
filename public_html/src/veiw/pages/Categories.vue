<template lang="pug">
	.categories
		.divide-head {{categories[category]}}
		.category-block
			.list
				.item(v-for='v, k in categories[category].list' @click='curItem = k') {{v}}
			.grid
				.grid-head {{curItem ? categories[category].list[curItem] : ''}}
				.grid-params
					.color Color
					.height Height
				.grid-items(v-if='curItem')
					.grid-item(v-for='item in filteredGoods')
						img(:src='require("@/img" + item.img)')
						.title {{item.title}}
						.price {{item.price}} грн
						router-link.btn(:to='"/catalog/" + item.category + "/" + item.id') Детальніше
						.btn(@click='') Оформити замовлення
</template>

<script>
	export default {
		name: 'page-categories',
		data() {
			return {
				curItem: '',
				categories: {
					'pave': {
						title: 'Тротуарні елементи',
						list: {
							bruk: 'Бруківка',
							square: 'Квадрат',
							old: 'Старе місто',
							t: 'Подвійна Т'
						}
					},
					'road': {
						title: 'Дорожні елементи',
						list: {
							bruk: 'Бруківка',
							square: 'Квадрат',
							old: 'Старе місто',
							t: 'Подвійна Т'
						}
					},
					'vert': {
						title: 'Вертикальні елементи',
						list: {
							bruk: 'Бруківка',
							square: 'Квадрат',
							old: 'Старе місто',
							t: 'Подвійна Т'
						}
					}
				},
				goods: null
			}
		},
		computed: {
			category() {
				return this.$route.params.category
			},
			filteredGoods() {
				return this.goods
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