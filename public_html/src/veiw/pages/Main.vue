<template lang="pug">
	.main
		img.logo-mob(:src="require('@/img/brand/logo-big-blue.png')" alt='Blagobud-logo')
		slider.slider(:items='formedSale' auto='0' interval='7000')
		.inner-wrapper
			.inf-icons
				.inf-ico
					i.ico.fas.fa-at
					.lable Онлайн замовлення
				.inf-ico
					i.ico.fas.fa-thumbs-up
					.lable Актуальні ціни
				.inf-ico
					i.ico.fas.fa-award
					.lable Якісна продукція
				.inf-ico
					i.ico.fas.fa-shipping-fast
					.lable Оперативна доставка
		.inner-wrapper
			.goods-banner
				a.good-item(
					v-for='item in goodsBannerItems'
					:href='item.url'
					:style='"background-image: url(" + require("@/img/plug/" + item.img + ".jpg") + ")"'
					) 
					.good-item-inner {{item.title}}
						.btn Детальніше
		.inner-wrapper
			.vereteno
				h3 Популярні товари
				.vereteno-inner(v-if='goods')
					i.fas.fa-chevron-circle-left.left.arr(@click='slideVereteno(0)')
					i.fas.fa-chevron-circle-right.right.arr(@click='slideVereteno(1)')
					.item(v-for='item in cur')
						img(:src='require("@/img" + goods[item].img)')
						.title {{goods[item].title}}
						a.btn(:href='"/catalog/" + goods[item].category + "/" + goods[item].id') Детальніше
		.news
			h3 Новини
			.inner-wrapper
				template(v-for='item in news')
					.pos-wrap
						.pos-left
							router-link.item(
									:key='item[0].img'
									:to='"/news/" + item[0].id'
									:style='"background-image: url(" + require("@/img" + item[0].img) + ")"'
								)
								.title {{item[0].title}}
									.date {{item[0].datetime}}
						.pos-right
							router-link.item(
									:key='item[1].img'
									:to='"/news/" + item[1].id'
									:style='"background-image: url(" + require("@/img" + item[1].img) + ")"'
								)
								.title {{item[1].title}}
									.date {{item[1].datetime}}
							router-link.item(
									:key='item[2].img'
									:to='"/news/" + item[2].id'
									:style='"background-image: url(" + require("@/img" + item[2].img) + ")"'
								)
								.title {{item[2].title}}
									.date {{item[2].datetime}}
			.btn(@click='loadNewsList') Показати більше

</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-main',
		data() {
			return {
				cur: [0,1,2,3],
				goodsBannerItems: [
					{
						url: '/catalog/pave',
						img: 'trot',
						title: 'Тротуарна плитка'
					},
					{
						url: '/catalog/road',
						img: 'dor',
						title: 'Дорожні елементи'
					},
					{
						url: '/catalog/vert',
						img: 'vert',
						title: 'Вертикальні елементи'
					}
				],
				goods: null,
				news: [],
				newsPortion: 1,
				sale: []
			}
		},
		computed: {
			formedSale() {
				return this.sale.map(e => {
					return {
						...e,
						url: '/sale/' + e.id
					}
				})
			}
		},
		methods: {
			slideVereteno(d) {

				if (d) {
					this.cur = this.cur.map(e => {
						e++;
						if (e > this.goods.length - 1) return 0;
						return e;
					})
				}
				if (!d) {
					this.cur = this.cur.map(e => {
						e--;
						if (e < 0) return this.goods.length - 1;
						return e
					})
				}
			},
			async loadGoodsList(opts = {}) {
				let res = await this.request({
					method: 'get',
					className: 'Catalog',
					methodName: 'getGoods'
				})
				this.goods = res.data;
			},
			async loadNewsList(opts = {}) {

				if (opts.init) {
					this.newsPortion = 1
				}
				else  {
					this.newsPortion++
				}

				let res = await this.request({
					method: 'get',
					className: 'News',
					methodName: 'getRows',
					opts: {
						offset: (this.newsPortion - 1) * 3,
						limit: 3
					}
				})
				this.news.push(res.data)
			},
			async loadSales() {
				this.sale = (await this.request({
					method: 'get',
					className: 'Sale',
					methodName: 'getRows',
				})).data
			}
		},
		mounted() {
			this.loadGoodsList({init:1});
			this.loadNewsList({init:1});
			this.loadSales({init:1});
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/main.scss"></style>