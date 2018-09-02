<template lang="pug">
	#app
		page-header(view='narrow' v-if='isHeader')
		.main-block
			router-view
			callback(v-if='isCallback')
			up(v-if='isUp')
			transition(name='appear')
				.result-message(v-if='showMessage' v-html='showMessage')
		page-footer(v-if='isFooter')
		
</template>

<script>
	export default {
		name: 'App',
		data() {
			return {
				showMessage: null,
				isHeader: 1,
				isFooter: 1,
				isCallback: 1,
				isUp: 1,
			}
		},
		mounted() {
			[].forEach.call(this.$children, e => {
				if (e.viewOpts) {
					for (let key in e.viewOpts) {
						this[key] = e.viewOpts[key]
					}
				}
			})
		}
	}
</script>

<style lang="scss" src="@/scss/app.scss"></style>