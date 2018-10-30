<template lang="pug">
	.admin
		.admin-head
			a.slide.bg-brand.snow(href='/')
				i.fas.fa-angle-double-left.snow
				| На головну
			.slide(
				v-for='i in sets'
				@click='curSet = i'
				:class='curSet && i.table == curSet.table ? "bg-grass snow active" : "bg-dust"'
				)
					i(:class='i.cls')
					| {{i.name}}
			template(v-if='curSet && curSet.table !== "pages"')
				.bb-btn.brand.add-new(@click='showForm') Додати
		.admin-body(
			v-if='curSet && curSet.data'
			:class='curSet.table == "pages" ? "flexbox flex-wrap" : ""'
		)
			template(v-if='curSet.table == "pages"')
				div.page-esc(v-for='page in curSet.data' @click='curPage = page')
					.title {{page.title}}
					.text(v-html='page.description')
			template(v-else-if='curSet.table == "meta"')
				table
					tbody
						tr(v-for="val, key in curSet.data[0]")
							td {{fields[key] || key}}
							td
								template(v-if="key == 'id'") {{val}}
								template(v-else-if='key === "price_url"')
									label.fas.fa-file-pdf(
										for='file'
									)
									input#file(type='file' style="display: none" @change='fileChoose')
								template(v-else)
									input(v-model='curSet.data[0][key]' @change='changeText(curSet.data[0], key)')
			template(v-else)
				.filters-row
					p.filter-item
						label id
						input(type="nuber" v-model="filters.id")
					p.filter-item(v-if="curSet.table == 'goods'")
						label Категорія
						select(v-model="filters.category")
							option(v-for='category, key in categories' :value='key') {{category}}
					p.filter-item(v-if="curSet.table == 'goods'")
						label Тип
						select(v-model="filters.type")
							option(v-for='type, key in goods' :value='key') {{type}}
				table
					thead
						tr
							th(v-for='v, k in curSet.data[0]') {{fields[k] || k}}
					tbody
						tr(v-for='item in filteredData')
							td(v-for='f, key in item')
								template(v-if='key === "datetime" || key == "folder"') {{f}}
								template(v-else-if='key === "id"')
									template(v-if="curSet.table == 'goods'")
										a(:href="'/catalog/' + item.category + '/' + f") {{f}}
									template(v-else)
										a(:href="'/' + curSet.table + '/' + f") {{f}}
									br
									a.lady(href='javascript:;' @click='deleteRow(item.id)') (видалити)
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
								template(v-else-if='key === "description"')
									div.page-esc( style='height: 100px; width: 80%' @click='curPage = item')
										.text(v-html='f')
								template(v-else)
									input(v-model='item[key]' @change='changeText(item, key)')
		transition(name='appear')
			img-loader(v-if='loadImg' @close='imgLoaded' :data='loadImg')
		transition(name='appear')
			.new-form(v-if='newForm')
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
				.bb-btn.lady.wide(@click='newForm = null') Закрити без збереження
		transition(name='appear')
			text-editor(v-if='curPage' :value='curPage.description' @close='changePageData')

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
				filters: {},
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
						data: null,
						cls: 'fas fa-shopping-cart'
					},
					{
						name: "Новини",
						table: "news",
						data: null,
						cls: 'far fa-newspaper'
					},
					{
						name: "Корисна інформація",
						table: "info",
						data: null,
						cls: 'fas fa-info'
					},
					{
						name: "Акції",
						table: "sales",
						data: null,
						cls: 'fas fa-tags'
					},
					{
						name: "Кольори",
						table: "colors",
						data: null,
						cls: 'fas fa-palette'
					},
					{
						name: "Сторінки",
						table: "pages",
						data: null,
						cls: 'fas fa-file-alt'
					},
					{
						name: "Мета дані",
						table: "meta",
						data: null,
						cls: 'fas fa-cogs'
					},
				],
				fields: {
					category: 'Категорія',
					img: 'Картинка',
					title: 'Заголовок',
					description: 'Опис',
					price: 'Ціна',
					type: 'Тип',
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
					price_url: "Прайсинг",
					street: "Адреса",
					city: "Місто",
					region: "Регіон",
					district: "Район",
					country: "Країна",
					index: "Поштовий індекс",
					phone: "Телефон",
					email: "E-mail",
					edrpou: "ЄДРПОУ",
					inn: "ІНН",
					time: "Час",
				}
			}
		},
		computed: {
			filteredData() {
				let fil = this.curSet.data;
				if (this.filters.id) {
					fil = fil.filter(e => e.id == this.filters.id);
				}
				if (this.curSet.table == 'goods') {
					if (this.filters.category) {
						fil = fil.filter(e => e.category == this.filters.category);
					}
					if (this.filters.type) {
						fil = fil.filter(e => e.type == this.filters.type);
					}
				}

				return fil;
			}
		},
		methods: {
			async fileChoose(e) {
				let price_url = await this.loadFile(e);
				console.log(price_url);
				await this.admin('changeField',{table: 'meta',key: 'price_url',data: {...this.curSet.data[0], price_url}});
			},
			async load() {
				if (!this.curSet.data) {
					let table = this.curSet.table;
					this.curSet.data = (await this.admin('getRows', {table})).data;
				}
			},
			changeText(data, key) {
				let table = this.curSet.table;
				this.admin('changeField',{table,key,data});
			},
			async changePageData(pageData) {
				if (pageData) {
					let table = this.curSet.table;
					this.curPage.description = pageData.html;
					let data = this.curPage;
					if (this.curSet.table == 'pages') {
						let res = await this.admin('changePageData', {table, data});
					}
					else {
						let res = await this.changeText(data, 'description');
					}
				}
				this.curPage = null;
			},
			async deleteRow(id) {
				let table = this.curSet.table;
				await this.admin('deleteRow', {table,id});
				this.curSet.data = this.curSet.data.filter(e => {
					return e.id != id
				})
			},
			async imgLoaded(url) {
				if (url) {
					let table = this.curSet.table;
					let key = 'img';
					let data = {...this.loadImg, img: url};
					await this.admin('changeField',{table,key,data});
					this.loadImg.img = url
				}
				this.loadImg = null
			},
			async addRow(data) {
				let table = this.curSet.table;
				let res = await this.admin('addRow',{table, data});
				if (res) {
					this.curSet.data.push(data)
					this.newForm = null
				}
			},
			async showForm() {
				console.log(1);
				let table = this.curSet.table;
				let form = {};
				let i = (await this.admin('getFields', {table})).data;
				i.forEach(e => {
					if (e == 'datetime') {}
					else {
						form[e] = null;
					}
				});
				this.newForm = form
			},
			async getColors() {
				this.colors = (await this.admin('getColors')).data;
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