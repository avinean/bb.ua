<template lang="pug">
	.productpage
		.inner-wrapper
			.content-block(v-if='this.item') 
				.card
					.image(:style='"background-image: url(" + item.img + ")"')
						<!--img(:src='item.img')-->
					.short-info
						.title {{item.title}}
						hr.devider
						.hz Виняткова універсальність
						.bb-btn.wide.brand(@click='showPopup = {}') Оформити замовлення
				.full-info
					.info-row(v-for='title, key in characs' v-if='item[key]')
						strong.key {{title}}: 
						.val {{item[key]}}
		.contact-us(style='background-image: url(/img/plug/trot.jpg)')
			.bgc
				.title
					h3 Виникли питання?
					p Заповніть номер телефону та отримайте безкоштовну консультаці від наших менеджерів
				.form
					input(v-model='phone' placeholder='Ваш номер телефону')
					.btn(@click='send(0)') Замовити консультацію
		.inner-wrapper
			.vereteno
				h3 Супутні товари
				.vereteno-inner(v-if='goods')
					//- i.fas.fa-chevron-circle-left.left.arr(@click='slideVereteno(0)')
					//- i.fas.fa-chevron-circle-right.right.arr(@click='slideVereteno(1)')
					.item(v-for='item in cur')
						img(:src='goods[item].img')
						.title {{goods[item].title}}
						a.bb-btn.cherry(:href='"/catalog/" + goods[item].category + "/" + goods[item].id') Детальніше
		popup.popup(v-if='showPopup' @close='showPopup = null')
			template(slot='head') Ми зателефонуємо Вам на протязі 15 хвилин
			.form(slot='body')
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(v-model='showPopup.phone' placeholder='Вкажіть номер Вашого телефону')
					input.input-field(v-model='showPopup.cnt' placeholder='Вкажіть кількість')
			div(slot='foot')
				.bb-btn.brand(@click='send(1)') Відправити
</template>

<script>
	export default {
		name: 'page-productpage',
		data() {
			return {
				cur: [0,1,2,3],
				item: null,
				phone: '',
				goods: null,
				showPopup: null,
				characs: {
					material: "Матеріал",
					color: "Колір",
					length: "Довжина",
					width: "Ширина",
					height: "Товщина",
					size: "Розмір",
					row_weight: "Вага 1 кв. м, кг",
					size_in_complect: "Розміри в комплекті, см",
					type2: "Тип",
					cases: "Умови експлуатації",
					items: "Одиниця виміру",
					brand: "Бренд",
					fasc: "Наявність фаски",
					surface: "Поверхня",
					mount: "Укладка",
					metr_in_row: "Квадратних метрів в ряду на палеті, кв. м",
					rows_in_palet: "Кількість рядів на палеті",
					metr_in_palet: "Укладальна площа з 1 палети, кв. м",
					palet_weight: "Вага 1 палети, кг",
					beton_class: "Клас бетону",
					items_in_palet: "Кількість на 1 піддоні, шт",
					items_in_row: "Кількість в 1 ряду на піддоні, шт",
					item_weight: "Вага 1 шт, кг",
					index_izo: "Індекс ізоляції повітряного шуму для одиничного блока Rw, дб",
					fire_destiny: "Межа вогнестійкості R/EI, мин",
					items_in_metr: "Кількість на 1 кв. м кладки",
					items_in_cub_metr: "Кількість в 1 куб. м",
					complectation: "Комплектація",
					mark_strength: "Марка за міцностю",
					mark_frost: "Марка за морозостійкістю",
				}
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
			send(i) {
				let opts
				if (i) {
					console.log(i);
					
					if (!this.showPopup.phone || !this.showPopup.name || !this.showPopup.cnt)  {
						alert('Введіть будь-ласка повні дані');
						return;
					}
					opts = {
						method: 'get',
						className: 'Contacts',
						methodName: 'sendOrder',
						opts: {
							phone: this.showPopup.phone,
							name: this.showPopup.name,
							cnt: this.showPopup.cnt,
							id: this.$route.params.id
						}
					}
				}
				else {
					if (!this.phone) {
						alert('Введіть будь-ласка Ваш номер телефону');
						return;
					}
					opts = {
						method: 'get',
						className: 'Contacts',
						methodName: 'sendCallBack',
						opts: {
							phone: this.phone
						}
					}
				}

				this.request(opts)
				this.showPopup = null;
				this.$parent.showMessage = `
					Дякуємо! 
					<br> Ваш запит відправлено
				`
				setTimeout(e => this.$parent.showMessage = null, 3000)
			}
		},
		async mounted() {
			this.item = (await this.request({
				method: 'get',
				className: 'Catalog',
				methodName: 'getProduct',
				opts: {
					id: this.$route.params.id
				}
			})).data

			this.loadGoodsList({init:1});
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/productpage.scss"></style>