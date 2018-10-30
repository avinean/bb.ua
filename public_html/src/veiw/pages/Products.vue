<template lang="pug">
	.products
		.inner-wraper
			.divide-head {{categories[category].title}}
			.category-block
				.list
					.item(v-for='v, k in categories[category].list' @click='curItem = k') {{v}}
					a.price(:href='meta.price_url' download="price" @click='showMessage')
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
									@click='curColors.includes(+color) ? curColors = remove(curColors, +color) : curColors.push(+color)'
									:class='curColors.includes(+color) ? "bg-lady snow" : "bg-dust"'
								) {{colorsMap[+color]}}
									i.fas.fa-times(v-if='curColors.includes(+color)')
						.params-block(v-if='category == "pave"')
							.title Висота, см
							.params-items
								span.params-item(
									v-for='height in heights'
									@click='curHeights.includes(height)  ? curHeights = remove(curHeights, height) : curHeights.push(height)'
									:class='curHeights.includes(height) ? "bg-lady snow" : "bg-dust"'
								) {{height}}
									i.fas.fa-times(v-if='curHeights.includes(height)')
						.params-block(v-else)
							.title Розмір, см
							.params-items
								span.params-item(
									v-for='size in sizes'
									@click='curSizes.includes(size)  ? curSizes = remove(curSizes, size) : curSizes.push(size)'
									:class='curSizes.includes(size) ? "bg-lady snow" : "bg-dust"'
								) {{size}}
									i.fas.fa-times(v-if='curSizes.includes(size)')
					.clear-filter(v-if='curHeights.length || curColors.length' @click='curHeights = []; curColors = []') Очистити всі фільтри
					.grid-items(v-if='curItem')
						.grid-item(v-for='item in filteredGoods')
							img(:src='item.img')
							.title {{item.title}} <br>
								|
								span.short-desc ({{colorsMap[item.color]}}, {{category == 'pave' ? item.height+" см" : item.size+" см"}})
							.price {{item.price}} грн
							router-link.bb-btn.brand(:to='"/catalog/" + item.category + "/" + item.id') Детальніше
</template>

<script>
	export default {
		name: 'page-products',
		data() {
			return {
				curColors: [],
				curHeights: [],
				curSizes: [],
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
							bort: 'Борт дорожній',
							bord: 'Бордюр парковий',
						}
					},
					'vert': {
						title: 'Вертикальні елементи',
						list: {
							wall: 'Блок стіновий',
							brik: 'Блок перегородковий',
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
					return this.goods.map(e => e.type === this.curItem ? e.height : null)
					.filter(e=>e)
					.filter((a,b,c) => b === c.indexOf(a))
					.sort()
				}
			},
			sizes() {
				if (this.goods) {
					return this.goods.map(e => e.type === this.curItem ? e.size : null)
					.filter(e=>e)
					.filter((a,b,c) => b === c.indexOf(a))
				}
			},
			colors() {
				if (this.goods) {
					return this.goods.map(e => e.type === this.curItem ? e.color : null)
					.filter(e=>e)
					.filter((a,b,c) => b === c.indexOf(a))
				}
			},
			filteredGoods() {
				if (this.goods) {
					let temp = this.goods;
					if (this.curItem) {
						temp = temp.filter(e => e.type === this.curItem)
					}
					if (this.curColors.length) {
						temp = temp.filter(e => this.curColors.includes(+e.color))
					}
					if (this.curHeights.length) {
						temp = temp.filter(e => this.curHeights.includes(e.height))
					}
					return temp;
				}
			}
		},
		methods: {
			showMessage() {
				// console.log(1);
				setTimeout(() => {
					this.$parent.showMessage = `
					Дякуємо, що вибрали продукцію
					<br> виробничої компанії «Благобуд»!
				`;
					setTimeout(() => this.$parent.showMessage = null, 5000);
				}, 500);
			},
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
			defineCur() {
				if (this.category === 'pave') {
					this.curItem = 'bruk'
				}
				else if (this.category === 'road') {
					this.curItem = 'bort'
				}
				else if (this.category === 'vert') {
					this.curItem = 'wall'
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