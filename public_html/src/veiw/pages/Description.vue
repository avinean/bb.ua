<template lang="pug">
	.description
		.inner-wrapper
			.content-block(v-if='this.item') 
				p {{item.id}}
				p {{item.img}}
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-description',
		data() {
			return {
				item: null
			}
		},
		computed: {
			...mapState(['goods']),
		},
		mounted() {
			let p = this.$route.params
			this.item = this.goods[p.category][p.id]
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/description.scss"></style>