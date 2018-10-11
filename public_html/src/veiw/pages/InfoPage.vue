<template lang="pug">
	.payment
		.inner-wrapper
			.content-block
				.divide-head {{title}}
				div {{content}}
			callback(simple='1' key='123')
</template>

<script>
	export default {
		name: 'page-payment',
		data() {
			return {
				title: '',
				content: ''
			}
		},
		computed: {
			page() {
				return this.$route.path.split('/')[1]
			}
		},
		methods: {
			async initPage() {

				this.title = ''
				this.content = ''

				let res = await this.request({
					method: 'get',
					className: 'InfoPage',
					methodName: 'getPage',
					opts: {
						page: this.page
					}
				})

				this.title = res.title
				this.content = res.template
			}
		},
		watch: {
			page() {
				this.initPage()
			}
		},
		mounted() {
			this.initPage()
		}
	}
</script>

<!--<style lang="scss" scoped src="@/scss/pages/payment.scss"></style>-->