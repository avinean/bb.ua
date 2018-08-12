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
						url: '/'
					},
					{
						name: 'Доставка',
						url: '/'
					},
					{
						name: 'Акції',
						url: '/'
					}
				]
			},
			{
				name: 'Про благобуд',
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
			street: 'вул. Будівельна, 13',
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
		prices: {
			bruk: {
				name: 'Бруківка',
				price: [
					['200х100х40', '204.00', '229.20', '229.20', '229.20', '229.20', '229.20', '268.80', '268.80', '268.80', '285.60', '336.00'],
					['200х100х60', '224.40', '240.00', '240.00', '240.00', '240.00', '240.00', '296.40', '296.40', '296.40', '307.20', '355.68'],
					['200х200х60', '224.40', '240.00', '240.00', '240.00', '240.00', '240.00', '296.40', '296.40', '296.40', '307.20', '355.68'],
					['200х100х80', '290.40', '316.80', '316.80', '316.80', '316.80', '316.80', '398.40', '398.40', '398.40', '418.32', '478.08'],
				]
			},
			old: {
				name: 'ФЕМ «Старе місто» – комплект з 4-х форм',
				price: [
					['60/90/120/180х120х40', '204.00', '229.20', '229.20', '229.20', '229.20', '229.20', '268.80', '268.80', '268.80', '285.60', '336.00'],
					['60/90/120/180х120х60', '224.40', '240.00', '240.00', '240.00', '240.00', '240.00', '296.40', '296.40', '296.40', '307.20', '355.68']
				]
			},
			t: {
				name: 'ФЕМ «Подвійне Т»',
				price: [
					['200х160х60', '224.40', '240.00', '240.00', '240.00', '240.00', '240.00', '296.40', '296.40', '296.40', '307.20', '355.68',],
					['200х160х80', '290.40', '316.80', '316.80', '316.80', '316.80', '316.80', '398.40', '398.40', '398.40', '418.32', '478.08',]
				]
			},
			bort: {
				name: 'Борт дорожній',
				price: [
					['1000x300x150', '188.40']
				]
			},
			bord: {
				name: 'Бордюр парковий',
				price: [
					['1000x200x80', '97.20', '128.40', '128.40', '128.40', '128.40', '128.40'],
				]
			},
			wallblock: {
				name: 'Блок стіновий',
				price: [
					['390x190x190', '27.00']
				]
			},
			block: {
				name: 'Блок перегородковий',
				price: [
					['390x190x90', '13.20'],
				]
			},
			// circle: {
			// 	name: 'Кільця колодязні',
			// 	price: [
			// 		['1160(1000)x80x890', 316.20],
			// 		['1680(1500)x90x890', 986.40]
			// 	]
			// },
		},
		sale: [
			{
				title: 'Акція 1',
				description: 'huiHuh f fsidfh sdfdfh sdfhssdfhohweh wefh owih  oohsiohfsoeh l vioh ori',
				img: '/price/t.jpg',
				url: '/',
				id: 1
			},
			{
				title: 'Акція 2',
				description: 'huiHuh f fsidfh sdfdfh sdfhssdfhohweh wefh owih  oohsiohfsoeh l vioh ori',
				img: '/price/bruk.jpg',
				url: '/',
				id: 2
			},
			{
				title: 'Акція 3',
				description: 'huiHuh f fsidfh sdfdfh sdfhssdfhohweh wefh owih  oohsiohfsoeh l vioh ori',
				img: '/price/old.jpg',
				url: '/',
				id: 3
			}
		]
	}
})