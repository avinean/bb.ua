<template lang="pug">
	.admin
		.admin-head
			.slide(v-for='i in sets' @click='curSet = i' :class='curSet && i.table == curSet.table ? "bg-grass snow" : "bg-dust"') {{i.name}}
		.admin-body(v-if='curSet && curSet.data')
			.btn(@click='addNew')
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
							template(v-if='key === "id" || key === "datetime"') {{f}}
							template(v-else-if='key === "img"')
								img(
									:src='f' 
									style='width: 50px; cursor: pointer'
									@click='loadImg = item'
								)
							template(v-else)
								input(v-model='item[key]' @change='changeText(item, key)')
		transition(name='appear')
			img-loader(v-if='loadImg' @close='imgLoaded')

</template>

<script>
	export default {
		name: 'page-admin',
		data() {
			return {
				viewOpts: {
					isHeader: 0,
					isFooter: 0,
					isCallback: 0,
					isUp: 0
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
					}
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
					val: 'Значення'
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
				if (!confirm('Ви впевнені, що хочете змінити дані?')) return
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
				if (!confirm('Ви впевнені, що хочете видалити дані?')) return
				let res = (await this.admin({
					methodName: 'deleteRow',
					opts: {
						table: this.curSet.table,
						id
					}
				}))
				this.curSet.data = this.curSet.data.filter(e => e.id !== id)
			},
			async imgLoaded(url) {
				let res = (await this.admin({
					methodName: 'changeField',
					opts: {
						table: this.curSet.table,
						key: 'img',
						data: {...this.loadImg, img: url}
					}
				}))
				if (url) {
					this.loadImg.img = url
				}
				this.loadImg = null
			}
		},
		watch: {
			curSet() {
				this.load()
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/admin.scss"></style>