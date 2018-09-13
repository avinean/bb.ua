<template lang="pug">
	.withbanner-page
		.content-block
			.divide-head {{classes[this.page].title}}
			.item(
					v-for='item in rows'
					:key='item.img'
				)
				.image(style='background-image: url(/img" + item.img)')
				.text
					.title {{item.title}}
					.date
						i.fas.fa-calendar-alt
						|   {{item.datetime}}
					.description {{item.description.slice(0, 100) + ' ...'}}
					router-link.link(:to='"/" + page + "/" + item.id') Читати далі >
			.btn(@click='loadRows') Показати більше
		router-link.banner(
			:to='"/catalog/"'
			style='background-image: url(/img/plug/road.jpg)'
			) 250 видів тротуарної плитки

</template>

<script>
	export default {
		name: 'page-articles',
		data() {
			return {
				rows: [],
				portion: 1,
				classes: {
					sale: {
						className: 'Sale',
						title: 'Акції'
					},
					news: {
						className: 'News',
						title: 'Новини'
					},
					info: {
						className: 'Info',
						title: 'Корисна інформація'
					},
				}
			}
		},
		computed: {
			page() {
				return this.$route.path.split('/')[1]
			}
		},
		methods: {
			async loadRows(opts = {}) {

				if (opts.init) {
					this.rows = []
					this.portion = 1
				}
				else  {
					this.portion++
				}

				let res = await this.request({
					method: 'get',
					className: this.classes[this.page].className,
					methodName: 'getRows',
					opts: {
						offset: (this.portion - 1) * 3,
						limit: 3
					}
				})
				this.rows = this.rows.concat(res.data)
			}
		},
		watch: {
			page() {
				this.loadRows({init: 1})
			}
		},
		mounted() {
			this.loadRows({init: 1})
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/withbanner-page.scss"></style>