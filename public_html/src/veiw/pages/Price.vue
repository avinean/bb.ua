<template lang="pug">
	.price
		.inner-wrapper
			.divide-head Прайс
			.table-wrap
				table
					thead
						tr
							th(colspan=2 rowspan=2) Найменування продукції
							th(rowspan=2) Розміри <br> ДхШхВ, мм
							th(:colspan='colors.length') Ціна, грн
						tr
							th(v-for='c in colors') {{c.name}}
								img.color(:src="require('@/img/price/' + c.url)")
					tbody
						template(v-for='(price, name) in filledPrices')
							tr(v-for='(size, i) in price.price')
								td.first-col(v-if='!i' :rowspan='price.price.length') {{price.name}}
								td(v-if='!i' :rowspan='price.price.length'): img.item(:src="require('@/img/price/' + name + '.jpg')")
								td(v-for='cost in size') {{cost}}
			.load
				a(download href='/store/price.pdf') Скачати прайс
				p * Ціни вказані за 1 м2 у гривні з ПДВ станом на 01.07.2018.
				p Відділ продажу ВК «БЛАГОБУД»
					span.sky +38 068 630 00 07
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-price',
		data() {
			return {
				colors: [
					{name: 'Сірий', url: 'grey.jpg'},
					{name: 'Венге', url: 'venge.jpg'},
					{name: 'Вишня', url: 'cherry.jpg'},
					{name: 'Графіт', url: 'grafit.jpg'},
					{name: 'Оливка', url: 'olive.jpg'},
					{name: 'Паприка', url: 'papric.jpg'},
					{name: 'Перлина', url: 'perl.jpg'},
					{name: 'Сахара', url: 'sahara.jpg'},
					{name: 'Бурштин', url: 'burshtyn.jpg'},
					{name: 'Тайга', url: 'taiga.jpg'},
					{name: 'Арктика', url: 'arctic.jpg'},
				]
			}
		},
		computed: {
			...mapState(['prices']),
			filledPrices() {
				let cl = this.colors.length + 1

				for (let key in this.prices) {
					this.prices[key].price.forEach(e => {
						for (let i = e.length; i < cl; i++) {
							e.push('-')
						}
					})
				}

				return this.prices
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/price.scss"></style>