<template lang="pug">
	.products
		.inner-wraper
			.divide-head {{categories[category].title}}
			.category-block
				.list
					.item(v-for='v, k in categories[category].list' @click='curItem = k') {{v}}
					a.price(href='/store/price.pdf')
						i.fas.fa-file-pdf
						|Cкачати прайс
				.grid
					.grid-head {{curItem ? categories[category].list[curItem] : ''}}
					.grid-params
						.params-block
							.title Колір
							.params-items
								span.params-item(
									v-for='color in colors'
									@click='curColors.includes(color.id) ? curColors = remove(curColors, color.id) : curColors.push(color.id)'
									:class='curColors.includes(color.id) ? "bg-lady snow" : "bg-dust"'
								) {{color.title}}
									i.fas.fa-times(v-if='curColors.includes(color.id)')
						.params-block
							.title Висота, мм
							.params-items
								span.params-item(
									v-for='height in heights'
									@click='curHeights.includes(height)  ? curHeights = remove(curHeights, height) : curHeights.push(height)'
									:class='curHeights.includes(height) ? "bg-lady snow" : "bg-dust"'
								) {{height}}
									i.fas.fa-times(v-if='curHeights.includes(height)')
					.clear-filter(v-if='curHeights.length || curColors.length' @click='curHeights = []; curColors = []') Очистити всі фільтри
					.grid-items(v-if='curItem')
						.grid-item(v-for='item in filteredGoods')
							img(:src='require("@/img" + item.img)')
							.title {{item.title}}
							.price {{item.price}} грн
							router-link.btn(:to='"/catalog/" + item.category + "/" + item.id') Детальніше
							//- .btn(@click='') Оформити замовлення
</template>

<script>
	export default {
		name: 'page-products',
		data() {
			return {
				colors: [],
				curColors: [],
				curHeights: [],
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
			heights() {
				if (this.goods) {
					let h = this.goods.map(e => e.height)
					return h.filter((a,b,c) => b === c.indexOf(a)).sort()
				}
			},
			filteredGoods() {
				if (this.goods) {
					let temp = this.goods;
					if (this.curItem) {
						temp = temp.filter(e => e.type === this.curItem)
					}
					if (this.curColors.length) {
						temp = temp.filter(e => this.curColors.includes(e.color))
					}
					if (this.curHeights.length) {
						temp = temp.filter(e => this.curHeights.includes(e.height))
					}
					return temp;
				}
			}
		},
		methods: {
			async loadGoodsList() {
				this.goods = (await this.request({
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
				})).data;
			},
			async loadColors() {
				this.colors = (await this.request({
					method: 'get',
					className: 'Catalog',
					methodName: 'getColors'
				})).data;
			},
			defineCur() {
				if (this.category === 'pave') {
					this.curItem = 'bruk'
				}
				else if (this.category === 'road') {
					this.curItem = 'bruk'
				}
				else if (this.category === 'vert') {
					this.curItem = 'bruk'
				}
			},
			remove(arr, el) {
				return arr.filter(e => e != el)
				// console.log(arr)
			}
		},
		mounted() {
			this.defineCur()
			this.loadGoodsList()
			this.loadColors()
		},
		watch: {
			category() {
				this.defineCur()
				this.loadGoodsList()
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/products.scss"></style>