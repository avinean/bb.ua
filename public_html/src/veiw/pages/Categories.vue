<template lang="pug">
	.categories
		.inner-wrapper
			.content-block
				h3 {{categories[curCat]}}
				p(v-for='i in goods[curCat]') {{i.img}}
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-categories',
		data() {
			return {
				categories: {
					'pave': 'Тротуарні елементи',
					'road': 'Дорожні елементи',
					'vert': 'Вертикальні елементи'
				},
				curCat: null
			}
		},
		computed: {
			...mapState(['goods'])
		},
		methods: {
			async loadGoodsList() {
				let params = {
					category: this.curCat
				}
				let res = await this.request({
					method: 'get',
					className: 'Catalog',
					methodName: 'getGoodsByCategory',
					opts: {
						where: [
							{
								type: 's',
								comp: '=',
								val: 'pave',
								field: 'category'
							},
							{
								type: 'i',
								comp: '>',
								val: '0',
								field: 'id'
							}
						]
					}
				})
				console.log(res);
				
			}
		},
		mounted() {
			this.curCat = this.$route.params.category
			this.loadGoodsList()
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/categories.scss"></style>