<template lang="pug">
	.admin
		.admin-head
			.slide(
				v-for='i in sets'
				@click='curSet = i'
				:class='curSet && i.table == curSet.table ? "bg-grass snow active" : "bg-dust"'
				) {{i.name}}
		.admin-body(v-if='curSet && curSet.data')
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
						name: "Сторінки",
						table: "pages",
						data: null
					},
					// {
					// 	name: "Партнери",
					// 	table: "partners",
					// 	data: null
					// }
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
					val: 'Значення',
					datetime: 'Дата'
				},
				curSet: null,
				loadImg: false,
				newForm: null
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