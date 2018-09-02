<template lang="pug">
	.catalog
		.inner-wrapper
			.content-block
				.divide-head Каталог
			.goods-banner
				router-link.good-item(
					v-for='item in goodsBannerItems'
					:to='item.url'
					:style='"background-image: url(" + require("@/img/plug/" + item.img + ".jpg") + ")"'
					:key='item.url'
					)
					.good-item-inner {{item.title}}
						.btn Детальніше
				.good-item.info(
					:style='"background-image: url(" + require("@/img/plug/dor.jpg") + ")"'
					)
					span.title.info-title Корисна інформація
					.links
						router-link.link(
							v-for='inf in usefullInfo'
							:to='inf.url'
							:key='inf.url'
							)
							i(:class='inf.ico')
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
						img: 'trot',
						title: 'Тротуарна плитка'
					},
					{
						url: '/catalog/road',
						img: 'road',
						title: 'Дорожні елементи'
					},
					{
						url: '/catalog/vert',
						img: 'vert',
						title: 'Вертикальні елементи'
					}
				],
				usefullInfo: [
					{
						name: 'Вибір тротуарної плитки',
						ico: 'fas fa-chess-board',
						url: '/info/1'
					},
					{
						name: 'Рекомендації з улаштування основи',
						ico: 'fas fa-bars',
						url: '/info/2'
					},
					{
						name: 'Технології укладання бруківки',
						ico: 'fas fa-th-large',
						url: '/info/3'
					}
				]
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/catalog.scss"></style>