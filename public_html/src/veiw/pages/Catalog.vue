<template lang="pug">
	.catalog
		.inner-wrapper
			.content-block
				.divide-head Каталог
			.goods-banner
				router-link.good-item(
					v-for='item in goodsBannerItems'
					:to='item.url'
					:style='"background-image: url(" + item.img + ")"'
					:key='item.url'
					)
					.good-item-inner {{item.title}}
						.btn Детальніше
				.good-item.info(
					style='background-image: url(/img/catalog/dor.jpg)'
					)
					span.title.info-title
					.links
						router-link.link(
							v-for='inf in usefullInfo'
							:to='"/info/" + infoRelated[inf.key]'
							:key='inf.key'
							)
							span.ico
								i.snow(:class='inf.ico')
							span.name {{inf.name}}
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-catalog',
		data() {
			return {
				goodsBannerItems: [
					{
						url: '/catalog/pave',
						img: '/img/catalog/2_1.jpg',
						title: 'Тротуарна плитка'
					},
					{
						url: '/catalog/road',
						img: '/img/catalog/2_2.jpg',
						title: 'Дорожні елементи'
					},
					{
						url: '/catalog/vert',
						img: '/img/catalog/2_3.jpg',
						title: 'Вертикальні елементи'
					}
				],
				usefullInfo: [
					{
						name: 'Вибір тротуарної плитки',
						ico: 'fas fa-chess-board',
						key: 'vybir'
					},
					{
						name: 'Рекомендації з улаштування основи',
						ico: 'fas fa-bars',
						key: 'osnova'
					},
					{
						name: 'Технології укладання бруківки',
						ico: 'fas fa-th-large',
						key: 'ukladannya'
					}
				],
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/catalog.scss"></style>