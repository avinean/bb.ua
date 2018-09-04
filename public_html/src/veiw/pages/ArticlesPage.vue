<template lang="pug">
	.withbanner-page(v-if='page')
		.inner-wrapper
			.content-block(v-if='row')
				.single-article
					.image
						img(:src='require("@/img" + row.img)')
					.title {{row.title}}
					.date
						i.fas.fa-calendar-alt
						|   {{row.datetime}}
					.desc {{row.description}}
				hr.devider
				.share-block
					a.zmdi.zmdi-facebook.bg-facebook.share-link(:href='"http://www.facebook.com/sharer.php?u=" + linkUrl')
					a.zmdi.zmdi-google-plus.bg-google.share-link(:href='"https://plus.google.com/share?url=" + linkUrl')
					a.zmdi.zmdi-linkedin.bg-linkedin.share-link(:href='"https://www.linkedin.com/shareArticle?url=" + linkUrl')
					//- .bg-instagram.share-link(href='http://www.facebook.com/sharer.php?u=')
				.title Корисна інформація
				hr.devider
				.use-info
					router-link.info-item(to='/info/1')
						img(:src='require("@/img/plug/vybir.png")')
						.subs Вибір тротуарної плитки
					router-link.info-item(to='/info/2')
						img(:src='require("@/img/plug/osnova.png")')
						.subs Рекомендації з улаштування основи під тротуарну плитку
					router-link.info-item(to='/info/3')
						img(:src='require("@/img/plug/ukladannya.png")')
						.subs Технології укладання бруківки
			.banner
				router-link.new(v-for='item in news' :key='item.img' :to='"/news/" + item.id')
					img.image(:src='require("@/img" + item.img)')
					.text
						.title {{item.title}}
						.date
							i.fas.fa-calendar-alt
							|   {{item.datetime}}
					.clearfix
</template>

<script>
	export default {
		name: 'page-row',
		data() {
			return {
				news: [],
				row: null,
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
			},
			linkUrl() {
				return location.href + this.$route.path
			}
		},
		methods: {
			async load() {
				this.row = (await this.request({
					method: 'get',
					className: this.classes[this.page].className,
					methodName: 'getSingleRow',
					opts: {
						id: this.$route.params.id
						}
				})).data
			},
			async loadNews() {
				this.news = (await this.request({
					method: 'get',
					className: 'News',
					methodName: 'getRows',
					opts: {
						offset: 0,
						limit: 5
					}
				})).data
			}
		},
		watch: {
			linkUrl() {
				this.load();
			}
		},
		mounted() {
			this.load();
			this.loadNews()
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/withbanner-page.scss"></style>