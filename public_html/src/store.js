import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		popup: null,
		goods: {
			pave: {
				1: {
					img: "1.jpg",
					title: 'Some title',
					desc: 'Some descriptioncSome descriptionSome descriptionSome descriptionSome description',
					id: 1
				},
				2: {
					img: "2.jpg",
					title: 'Some title',
					desc: 'Some descriptioncSome descriptionSome descriptionSome descriptionSome description',
					id: 2
				},
				3: {
					img: "4.jpg",
					title: 'Some title',
					desc: 'Some descriptioncSome descriptionSome descriptionSome descriptionSome description',
					id: 3
				},
			},
			road: {
				4: {
					img: "3.jpg",
					title: 'Some title',
					desc: 'Some descriptioncSome descriptionSome descriptionSome descriptionSome description',
					id: 4
				},
				5: {
					img: "5.jpg",
					title: 'Some title',
					desc: 'Some descriptioncSome descriptionSome descriptionSome descriptionSome description',
					id: 5
				},
			},
			vert: {
				6: {
					img: "6.jpg",
					title: 'Some title',
					desc: 'Some descriptioncSome descriptionSome descriptionSome descriptionSome description',
					id: 6
				},
				7: {
					img: "7.jpg",
					title: 'Some title',
					desc: 'Some descriptioncSome descriptionSome descriptionSome descriptionSome description',
					id: 7
				}
			}
		},
		pages: [
			{
				name: 'Каталог продукції',
				url: '/catalog',
				children: [
					{
						name: 'Тротуарна плитка',
						url: '/catalog/pave'
					},
					{
						name: 'Дорожні елементи',
						url: '/catalog/road'
					},
					{
						name: 'Вертикальні елементи',
						url: '/catalog/vert'
					},
					{
						name: 'Сертифікати',
						url: '/quality'
					},
					{
						name: 'Оплата',
						url: '/payment'
					},
					{
						name: 'Доставка',
						url: '/arrival'
					},
					{
						name: 'Акції',
						url: '/sale'
					}
				]
			},
			{
				name: 'Про Благобуд',
				url: '/about'
			},
			{
				name: 'Диллерам',
				url: '/dillers'
			},
			{
				name: 'Новини',
				url: '/news',
				children: [
					{
						name: 'Корисна інформація',
						url: '/info'
					},
				]
			},
			{
				name: 'Контакти',
				url: '/contacts'
			},
		],
		contacts: {
			street: 'вул.Будівельна, 13',
			city: 'с. Білогородка',
			region: 'Київська область',
			district: 'Києво-Святошинський р-н',
			country: 'Україна',
			index: '08140',
			phone: '(068) 630 0007',
			email: 'sale.blagobud@ukr.net',
			edrpou: 41068374,
			inn: 1234567890
		},
	}
})