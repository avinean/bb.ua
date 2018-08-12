<template lang="pug">
	.main
		slider.slider(:items='sale' auto='1' interval='7000')
		.inner-wrapper
			.inf-icons
				.inf-ico
					i.ico.far.fa-check-square
					.lable Онлайн замовлення
				.inf-ico
					i.ico.fas.fa-map-marker-alt
					.lable Актуальні ціни
				.inf-ico
					i.ico.fas.fa-clipboard-list
					.lable Якісна продукція
				.inf-ico
					i.ico.far.fa-clock
					.lable Оперативна доставка
		.goods-banner
			a.good-item(
				v-for='item in goodsBannerItems' 
				:href='item.url'
				:style='"background-image: url(" + require("@/img/plug/" + item.img + ".jpg") + ")"'
				) {{item.title}}
		.vereteno
			h3 Популярні товари
			vereteno(:items='listedGoods')
		<!--.inner-wrapper.content-->
			<!--h3 Про нас-->
			<!--.content-section(v-for='(sup, i) in sups' :class='sup.pos')-->
				<!--span.fas.ico(:class='sup.color + " fa-" + sup.ico')-->
				<!--div.text-->
					<!--.title {{sup.title}}-->
					<!--.desc {{sup.desc}}-->
				<!--.clearfix-->
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-main',
		data() {
			return {
				sups: [
					{
						pos: "",
						ico: "clipboard-check",
						color: "sun",
						title: "Рекомендації",
						desc: "Компанія працює на ринку України 3 роки, і за цей час зарекомендувала себе надійним постачальником якісної продукції."
					},
					{
						pos: "rev",
						ico: "cubes",
						color: "sky",
						title: "Професіоналізм",
						desc: "ТОВ «ВК «Благобуд» спеціалізується на виробництві вібропресованої бетонної продукції: тротуарної плитки різних форм, кольорів, товщини; дорожного каменю та садового бордюра; стінових блоків і т.д."
					},
					{
						pos: "",
						ico: "cogs",
						color: "main",
						title: "Сучасність",
						desc: "Виробництво оснащене сучасними автоматизованими лініями, які забезпечують поліпшені експлуатаційні характеристики продукції. Сертифікована сировина, якісні формовочні матриці, професійний персонал, забезпечують точність та ідеальну геометрію форми виробів."
					},
					{
						pos: "rev",
						ico: "bong",
						color: "lady",
						title: "Якість",
						desc: "Якість продукції підтверджено відповідними сертифікатами, а також власниками товарно-транспортних комплексів, АЗС, супермаркетів, автостоянок, житлових і офісних комплексів."
					},
					{
						pos: "",
						ico: "handshake",
						color: "sky",
						title: "Партнерство",
						desc: "85% наших партнерів, прийшли по рекомендації інших клієнтів компанії. Серед них такі компанії як ТОВ «К.А.Н. Буд», ТОВ «ДБК-7»"
					},
					{
						pos: "rev",
						ico: "glasses",
						color: "grass",
						title: "Підтримка",
						desc: "Ви можете розраховувати на нас для оперативного і якісного вирішення Ваших задач, а саме головне, Ви будете задоволені результатом."
					},
					{
						pos: "",
						ico: "balance-scale",
						color: "sun",
						title: "Оптимальність",
						desc: "Ми пропонуємо оптимальні ціни, що дозволить Вам реально зекономити свої кошти та скоротити бюджет з благоустрою."
					},
					{
						pos: "rev",
						ico: "barcode",
						color: "main",
						title: "Вигода",
						desc: "ТОВ «ВК «Благобуд» пропонує вигідні умови співробітництва для дилерів та постійних оптових клієнтів."
					}
				],
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
			}
		},
		computed: {
			...mapState(['sale', 'goods']),
			listedGoods() {
				let list = []
				for (let key in this.goods) {
					for (let k in this.goods[key]) {
						this.goods[key][k].cat = key
						list.push(this.goods[key][k])
					}
				}
				return list;
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/main.scss"></style>