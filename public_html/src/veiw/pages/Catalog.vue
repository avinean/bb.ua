<template lang="pug">
	.catalog
		.inner-wrapper
			.content-block
				.divide-head Каталог
			.goods-banner
				a.good-item(
					v-for='item in goodsBannerItems'
					:href='item.url'
					:style='"background-image: url(" + require("@/img/plug/" + item.img + ".jpg") + ")"'
					)
					span.title {{item.title}}
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
					},
					{
						url: '/news',
						img: 'dor',
						title: 'Вертикальні елементи'
					}
				],
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/catalog.scss"></style>