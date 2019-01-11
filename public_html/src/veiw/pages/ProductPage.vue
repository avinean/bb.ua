<template lang="pug">
	.productpage
		.inner-wrapper
			.content-block(v-if='item')
				.card
					.image
						img(:src="item.img")
						p(:class="item.sale == 1 ? 'lined-text' : ''") {{item.price}} грн
					.short-info
						.title {{item.title}}
						hr.devider
						.hz(v-html='item.description')
						.bb-btn.wide.cherry(@click='showPopup = {}') Оформити замовлення
				.full-info
					.info-row(v-for='title, key in characs' v-if='item[key]')
						strong.key {{title}}: 
						.val(v-if="key == 'color'") {{colorsMap[item[key]]}}
						.val(v-else) {{item[key]}}
		.contact-us(:style="'background-image: url(' + getBanner('product_page_calback')[0] + ')'")
			.bgc
				.title
					h3 Виникли питання?
					p Заповніть номер телефону та отримайте безкоштовну консультацію від наших менеджерів
				.form
					input(v-model='phone' placeholder='Ваш номер телефону')
					.snow.btn(@click='send(0)') Замовити консультацію
		.inner-wrapper
			.vereteno
				h3 Супутні товари
				.vereteno-inner(v-if='unsortedGoods')
					span(@click='slideVereteno(0)')
						i.fas.fa-chevron-circle-left.left.arr.cherry
					span(@click='slideVereteno(1)')
						i.fas.fa-chevron-circle-right.right.arr.cherry
					.item(v-for='item in cur')
						img(:src='unsortedGoods[item].img')
						.title {{unsortedGoods[item].title}}
						a.bb-btn.cherry(:href='"/catalog/" + unsortedGoods[item].category + "/" + unsortedGoods[item].id') Детальніше
		popup.popup(v-if='showPopup' @close='showPopup = null')
			template(slot='head') Ми зателефонуємо Вам на протязі 15 хвилин
			.form(slot='body')
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(v-model='showPopup.phone' placeholder='Вкажіть номер Вашого телефону')
					input.input-field(v-model='showPopup.cnt' :placeholder='placeholder')
			div(slot='foot')
				.bb-btn.cherry(@click='send(1)') Відправити
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
					height_v: "Висота",
					size: "Розмір",
					row_weight: "Вага 1 кв. м, кг",
					size_in_complect: "Розміри в комплекті, мм",
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
		computed: {
			placeholder() {
				return this.$route.params.category === 'pave' ? 'Вкажіть кількість, м2' : 'Вкажіть кількість, шт';
			},
			unsortedGoods() {
				if (!this.goods) return;
				let categories = ['pave', 'road', 'vert'].filter(e => e !== this.$route.params.category);
				let goods = [...this.goods];
				if (this.$route.params.category === 'pave') {
					return [
						...goods.filter(e => categories.includes(e.category))							,
						...goods
							.filter(e => e.category === 'pave')
							.sort(e => Math.random() - 0.5)
							.slice(0,10)
					].sort(e => Math.random() - 0.5)
				}
				return goods
					.filter(e => categories.includes(e.category))
					.sort(e => Math.random() - 0.5);
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
				});
				this.goods = res.data;
			},
			send(i) {
				let opts;
				if (i) {
					
					if (!this.showPopup.phone || !this.showPopup.name || !this.showPopup.cnt)  {
						alert('Введіть будь-ласка повні дані');
						return;
					}

					if (!this.isValidPhone(this.showPopup.phone)) {
						return alert('Ви ввели недійсний номер телефону!');
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

					if (!this.isValidPhone(this.phone)) {
						return alert('Ви ввели недійсний номер телефону!');
					}
					opts = {
						method: 'get',
						className: 'Contacts',
						methodName: 'sendCallBack',
						opts: {
							phone: this.phone,
							url: this.$route.path,
							item: this.item,
							color: this.colorsMap[this.item.color]
						}
					}
				}

				this.request(opts);
				this.showPopup = null;

				this.showInfoMessage(`
					Дякуємо!
					<br> Звернення передано до Вашого персонального менеджера.
					<br> На протязі 15 хвилин з Вами зв'яжуться
				`, 3000, null, true);
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