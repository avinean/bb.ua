<template lang="pug">
	.admin
		.admin-head
			.btn(v-for='i in sets' @click='curSet = i' :class='curSet && i.table == curSet.table ? "bg-grass snow" : "bg-dust"') {{i.name}}
		.admin-body(v-if='curSet && curSet.data')
			table
				thead
					tr
						th(v-for='v, k in curSet.data[0]') {{fields[k] || k}}
				tbody
					tr(v-for='item in curSet.data')
						th(v-for='f, key in item')
							template(v-if='key === "id"') {{f}}
							template(v-else-if='key === "img"')
								img(:src='require("@/img" + f)' style='width: 50px')
							template(v-else)
								input(v-model='item[key]' @change='changeText(item.id, )')

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
				},
				curSet: null
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
			async changeText(arr) {
				if (!confirm('Ви впевнені, що хочете змінити дані?')) return
				console.log(arr);
				// let res = (await this.admin({
				// 	methodName: 'changeField',
				// 	opts: {
				// 		table: this.curSet.table
				// 	}
				// })).data
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