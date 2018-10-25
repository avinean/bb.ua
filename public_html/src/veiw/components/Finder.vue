<template lang="pug">
	.finder
		input.finder-input(
			v-if='find'
			type='text'
			autofocus
			v-model='searchVal'
			@keypress.enter='goToPage'
		)
		i.fas.fa-search.brand.search(@click='find = !find; searchVal = ""')
		<!--.searchRes(v-show='searchVal && filteredFinders.length && find')-->
			<!--router-link.brand.item(v-for='res in filteredFinders' :key='res.url' :to='res.url')-->
				<!--p.title {{res.title}}-->
				<!--span.url {{res.url}}-->
		<!--.hider(v-if='searchVal && filteredFinders.length && find'  @click='hideAll')-->

</template>

<script>
	export default {
		name: 'finder',
		data() {
			return {
				find: false,
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
		methods: {
			goToPage() {
				this.$router.push('/search?q=' + this.searchVal);
				this.$nextTick(() => this.hideAll());
			},
			hideAll() {
				this.find = false;
				this.searchVal = '';
			}
		}
	}
</script>

<style lang="scss" scoped>
	@import "@/scss/var.scss";

	.finder {
		position: relative;
		margin-left: auto;
		display: flex;
		align-items: center;

		.finder-input {
			border: none;
			outline: none;
			border-bottom: 2px solid $brand;
			margin: 0 10px;
			padding: 7px;
			background: rgba(255,255,255,0);
		}

		.search {
			cursor: pointer;
		}

		.searchRes {
			position: absolute;
			z-index: 999999999;
			width: 250px;
			overflow: hidden;
			background: white;
			top: 40px;
			padding: 0 10px;
			box-shadow: 0 0 12px 0;

			.item {
				display: block;
				margin-bottom: 10px;
				text-decoration: none;

				.title {
					text-transform: uppercase;
					margin-bottom: -7px;
					font-size: 16px;
					color: $brand;
				}

				.url {
					font-size: 12px;
					color: $brand;
				}
			}
		}

		.hider {
			position: fixed;
			width: 100vw;
			height: 100vh;
			top: 0;
			left: 0;
		}
	}
</style>