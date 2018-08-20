<template lang="pug">
	.news
		.content-block
			.divide-head Новини
			.item(
					v-for='item in news'
					:key='item.img'
				)
				.image(:style='"background-image: url(" + require("@/img" + item.img) + ")"')
				.text 
					.title {{item.title}}
					.date {{item.datetime}}
					.description {{item.description.slice(0, 100) + ' ...'}}
					router-link.link(:to='"/news/" + item.id') Читати далі >
			.btn(@click='loadNewsList') Показати більше
		router-link.banner(:to='"/catalog/"') banner

</template>

<script>
	export default {
		name: 'page-news',
		data() {
			return {
				news: []
			}
		},
		methods: {
			async loadNewsList(opts = {}) {

				if (opts.init) {
					this.news = []
					this.newsPortion = 1
				}
				else  {
					this.newsPortion++
				}

				let res = await this.request({
					method: 'get',
					className: 'News',
					methodName: 'getNews',
					opts: {
						offset: (this.newsPortion - 1) * 3,
						limit: 3
					}
				})
				this.news = this.news.concat(res.data)
			}
		},
		mounted() {
			this.loadNewsList({init: 1})
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/news.scss"></style>