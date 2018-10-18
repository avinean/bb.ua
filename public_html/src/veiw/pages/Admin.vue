<template lang="pug">
	.admin
		.admin-head
			.slide(
				v-for='i in sets'
				@click='curSet = i'
				:class='curSet && i.table == curSet.table ? "bg-grass snow active" : "bg-dust"'
				) {{i.name}}
		.admin-body(
			v-if='curSet && curSet.data'
			:class='curSet.table == "pages" ? "flexbox flex-wrap" : ""'
		)
			template(v-if='curSet.table == "pages"')
				div.page-esc(v-for='page in curSet.data' @click='curPage = page')
					.title {{page.title}}
					.text(v-html='page.template')
			template(v-else)
				.btn(@click='showForm') Додати
				table
					thead
						tr
							th
							th(v-for='v, k in curSet.data[0]') {{fields[k] || k}}
					tbody
						tr(v-for='item in curSet.data')
							td
								i.fas.fa-times(@click='deleteRow(item.id)')
							td(v-for='f, key in item')
								template(v-if='key === "id" || key === "datetime" || key == "folder"') {{f}}
								template(v-else-if='key === "category"')
									select(v-model='item[key]' @change='changeText(item, key)')
										option(v-for='category, key in categories' :value='key') {{category}}
								template(v-else-if='key === "type"')
									select(v-model='item[key]' @change='changeText(item, key)')
										option(v-for='good, key in goods' :value='key') {{good}}
								template(v-else-if='key === "color"')
									select(v-model='item[key]' @change='changeText(item, key)')
										option(v-for='color, key in colors' :value='color.id') {{color.title}}
								template(v-else-if='key === "img"')
									img(
										:src='f || "example.jpg"' 
										style='width: 50px; cursor: pointer'
										@click='loadImg = item; loadImg["folder"] = curSet.table'
									)
								template(v-else)
									input(v-model='item[key]' @change='changeText(item, key)')
		transition(name='appear')
			img-loader(v-if='loadImg' @close='imgLoaded' :data='loadImg')
		transition(name='appear')
			.new-form(v-if='newForm')
				i.close.fas.fa-times(@click='newForm = null')
				table
					tbody
						tr(v-for='v, k in newForm')
							template(v-if='k == "id" || k == "datetime" || k == "folder"')
							template(v-else-if='k == "img"')
								td {{fields[k] || k}}
								td 
									img(
										:src='v || "example.jpg"' 
										style='width: 50px; cursor: pointer'
										@click='loadImg = newForm; loadImg["folder"] = curSet.table'
									)
							template(v-else)
								td {{fields[k] || k}}
								td 
									input(v-model='newForm[k]')
				.bb-btn.brand(@click='addRow(newForm)') Зберегти
		transition(name='appear')
			text-editor(v-if='curPage' :value='curPage.template' @close='changePageData')

</template>

<script>
	export default {
		name: 'page-admin',
		data() {
			return {
				colors: [],
				viewOpts: {
					isHeader: 0,
					isFooter: 0,
					isCallback: 0,
					isUp: 0
				},
				curSet: null,
				loadImg: false,
				newForm: null,
				curPage: null,
				categories: {
					vert: "Вертикальні елементи",
					pave: "Тротуарна плитка",
					road: "Дорожні елементи"
				},
				goods: {
					wall: "Блок стіновий",
					brik: "Блок перегородковий",
					bort: "Борт дорожній",
					bord: "Бордюр дорожній",
					bruk: "Бруківка",
					old: "Старе місто",
					t: "Подвійне Т",
					square: "Квадрат"
				},
				sets: [
					{
						name: "Товари",
						table: "goods",
						data: null
					},
					{
						name: "Новини",
						table: "news",
						data: null
					},
					{
						name: "Корисна інформація",
						table: "info",
						data: null
					},
					{
						name: "Акції",
						table: "sales",
						data: null
					},
					{
						name: "Кольори",
						table: "colors",
						data: null
					},
					{
						name: "Контакти",
						table: "contacts",
						data: null
					},
					{
						name: "Сторінки",
						table: "pages",
						data: null
					},
				],
				fields: {
					category: 'Категорія',
					img: 'Картинка',
					title: 'Заголовок',
					description: 'Опис',
					price: 'Ціна',
					color: 'Колір',
					type: 'Тип',
					height: 'Висота',
					key: 'Ключ',
					name: 'Найменування',
					val: 'Значення',
					datetime: 'Дата',
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
			async load() {
				if (!this.curSet.data) {
					this.curSet.data = (await this.admin({
						methodName: 'getRows',
						opts: {
							table: this.curSet.table
						}
					})).data
				}
			},
			async changeText(data, key) {
				let res = (await this.admin({
					methodName: 'changeField',
					opts: {
						table: this.curSet.table,
						key,
						data
					}
				}))
			},
			async changePageData(data) {
				if (data) {
					this.curPage.template = data.html;
					let res = (await this.admin({
						methodName: 'changePageData',
						opts: {
							table: this.curSet.table,
							data: this.curPage
						}
					}))
				}
				this.curPage = null;
			},
			async deleteRow(id) {
				let res = (await this.admin({
					methodName: 'deleteRow',
					opts: {
						table: this.curSet.table,
						id
					}
				}))
				this.curSet.data = this.curSet.data.filter(e => {
					return e.id != id
				})
			},
			async imgLoaded(url) {
				if (url) {
					let res = (await this.admin({
						methodName: 'changeField',
						opts: {
							table: this.curSet.table,
							key: 'img',
							data: {...this.loadImg, img: url}
						}
					}))
					this.loadImg.img = url
				}
				this.loadImg = null
			},
			async addRow(data) {
				let res = (await this.admin({
					methodName: 'addRow',
					opts: {
						table: this.curSet.table,
						data
					}
				}))
				if (res) {
					this.curSet.data.push(data)
					this.newForm = null
				}
			},
			async showForm() {
				let form = {}
				let i = (await this.admin({
					methodName: 'getFields',
					opts: {
						table: this.curSet.table
					}
				})).data
				i.forEach(e => {
					if (e == 'id' || e == 'datetime') {}
					else {
						form[e] = null;
					}
				})
				this.newForm = form
			},
			async getColors() {
				this.colors = (await this.admin({
					methodName: 'getColors',
					opts: {}
				})).data
			}
		},
		watch: {
			curSet() {
				this.load()
			}
		},
		async mounted() {
			await this.getColors();
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/admin.scss"></style>