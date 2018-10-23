<template lang="pug">
	.search
		.inner-wrapper
			.finder-input
				input(
					type='text'
					autofocus
					v-model='searchVal'
				)
				i.fas.fa-search.bg-brand.snow
			.searchRes(v-if='searchVal && filteredFinders.length')
				router-link.brand.item.bg-dust(v-for='res in filteredFinders' :key='res.url' :to='res.url')
					span.url {{res.url}}
					p.title {{res.title}}
					.description(v-html='res.description.slice(0, 200)')
</template>

<script>
	export default {
		name: 'page-search',
		data() {
			return {
				searchVal: ''
			}
		},
		computed: {
			filteredFinders() {
				return this.finders
					.filter(e =>
						e.title.toLowerCase().includes(this.searchVal.toLowerCase()) ||
						e.description.toLowerCase().includes(this.searchVal.toLowerCase())
					)
					.slice(0, 10);
			}
		},
		mounted() {
			this.searchVal = this.$route.query.q;
		},
		watch: {
			'$route'() {
				this.searchVal = this.$route.query.q;
			}
		}
	}
</script>


<style lang="scss" scoped>
	@import "@/scss/var.scss";

	.search {

		.finder-input {
			width: 50%;
			min-width: 300px;
			height: 50px;
			display: flex;
			margin: 50px auto;
			text-align: center;

			input {
				flex-grow: 1;
				padding: 10px;
				font-size: 18px;
			}

			i {
				flex-basis: 100px;
				font-size: 28px;
				line-height: 50px;
			}
		}

		.searchRes {

			.item {
				display: block;
				margin-bottom: 10px;
				text-decoration: none;

				.title {
					text-transform: uppercase;
					font-size: 18px;
					color: $brand;
				}

				.url {
					margin-bottom: -7px;
					font-size: 12px;
					text-transform: uppercase;
					color: $brand;
				}
			}
		}
	}
</style>