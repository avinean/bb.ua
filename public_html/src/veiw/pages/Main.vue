<template lang="pug">
	.main
		img.logo-mob(src='/img/logo-big-blue.png' alt='Blagobud-logo')
		slider.slider(v-if="formedSale.length" :items='formedSale' auto='0' interval='7000')
		.inf-icons.inner-wrapper
			.inf-ico
				.ico-box: i.fas.fa-at.cherry
				.lable.main Онлайн замовлення
			.inf-ico
				.ico-box: i.fas.fa-thumbs-up.cherry
				.lable.main Актуальні ціни
			.inf-ico
				.ico-box: i.fas.fa-award.cherry
				.lable.main Якісна продукція
			.inf-ico
				.ico-box: i.fas.fa-shipping-fast.cherry
				.lable.main Оперативна доставка
		.goods-banner.inner-wrapper
			a.good-item(
				v-for='item in goodsBannerItems'
				:href='item.url'
				:style='"background-image: url(" + item.img + ")"'
				)
				.good-item-inner {{item.title}}
					.btn Детальніше
		.vereteno.inner-wrapper
			h2 Популярні товари
				.decor
					span.line
					span.romb
					span.line
			.vereteno-inner(v-if='unsortedGoods')
				span(@click='slideVereteno(0)')
					i.fas.fa-chevron-circle-left.left.arr.cherry
				span(@click='slideVereteno(1)')
					i.fas.fa-chevron-circle-right.right.arr.cherry
				.item(v-for='item in cur')
					img(:src='unsortedGoods[item].img')
					.title {{unsortedGoods[item].title}}
					a.bb-btn.cherry(:href='"/catalog/" + unsortedGoods[item].category + "/" + unsortedGoods[item].id') Детальніше
		.news.inner-wrapper
			h2 Новини
				.decor
					span.line
					span.romb
					span.line
			template(v-for='item in news')
				.pos-wrap
					.pos-left
						router-link.item(
								v-if='item[0]'
								:key='item[0].img + item[0].title + 1'
								:to='"/news/" + item[0].id'
								:style='"background-image: url(" + item[0].img + ")"'
							)
							.title {{item[0].title}}
								.date {{item[0].datetime}}
					.pos-right
						router-link.item(
								v-if='item[1]'
								:key='item[1].img + item[1].title + 2'
								:to='"/news/" + item[1].id'
								:style='"background-image: url(" + item[1].img + ")"'
							)
							.title {{item[1].title}}
								.date {{item[1].datetime}}
						router-link.item(
								v-if='item[2]'
								:key='item[2].img + item[2].title + 456'
								:to='"/news/" + item[2].id'
								:style='"background-image: url(" + item[2].img + ")"'
							)
							.title {{item[2].title}}
								.date {{item[2].datetime}}
			router-link.bb-btn.mid.brand(to="/news") Показати більше

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
						img: '/img/trot.jpg',
						title: 'Тротуарна плитка'
					},
					{
						url: '/catalog/road',
						img: '/img/dor.jpg',
						title: 'Дорожні елементи'
					},
					{
						url: '/catalog/vert',
						img: '/img/vert.jpg',
						title: 'Вертикальні елементи'
					}
				],
				goods: null,
				news: [],
				newsPortion: 1,
				sales: []
			}
		},
		computed: {
			formedSale() {
				return this.sales.map(e => {
					return {
						...e,
						url: e.id
					}
				})
			},
			unsortedGoods() {
				if (!this.goods) return;
				return this.goods.sort(e => Math.random() - 0.5);
			}
		},
		methods: {
			slideVereteno(d) {

				if (d) {
					this.cur = this.cur.map(e => {
						e++;
						if (e > this.unsortedGoods.length - 1) return 0;
						return e;
					})
				}
				if (!d) {
					this.cur = this.cur.map(e => {
						e--;
						if (e < 0) return this.unsortedGoods.length - 1;
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
				this.sales = (await this.request({
					method: 'get',
					className: 'Sales',
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