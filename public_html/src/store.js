import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		popup: null,
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
		]
	}
})