<template lang="pug">
	#app
		page-header(view='narrow' v-if='isHeader')
		.main-block(:style='styles')
			router-view
			callback(v-if='isCallback')
			up(v-if='isUp')
			div(ref="validTitle") {{ validTitle }}
			transition(name='appear')
				popup(v-if='showMessage !== null' @close='showMessage = null' nofooter="1")
					.message(slot='body' v-html='showMessage')
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
				styles: '',
				contacts: {},
				validTitle: ''
			}
		},
		async mounted() {
			if (this.$route.name === 'Admin') {
				this.styles = `
					    position: absolute;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						margin: auto;
						padding: 0;
				`
			}
			
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