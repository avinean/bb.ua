<template lang="pug">
	div
		.upheader
			.inner-wrapper
				router-link.logo(to='/')
					img(
						src='/img/logo-big-blue.png'
						alt='Blagobud-logo'
					)
				.address
					i.fas.fa-map-marked-alt.brand
					span
						strong Адреса:<br>
						| {{meta.city}}, <br>{{meta.street}}
				.time
					i.fas.fa-clock.brand
					span
						strong Графік роботи:
						|<br> {{meta.time}}
				.access
					i.fas.fa-at.brand
					span
						strong Приймання замовлень онлайн:
						|<br> Цілодобово
				.phone
					i.fab.fa-viber.brand
					i.fab.fa-whatsapp.grass
					|{{meta.phone}}
		.header(@mouseleave='children = null')
			.nav-panel
				.inner-wrapper.items-row
					p.x-wrapper(v-for='page in pages' @mouseenter='showList(page.children, $event)')
						router-link.nav-item(
							:key='page.name'
							:to='page.url'
						) {{page.name}}
							.after
					finder
			.nav-list(v-show='children' :style='"left: " + listPos + "px"')
				.arr
				.nav-item(v-for='child in children')
					router-link(:to='child.url') {{child.name}}
					.after
		.header-mob
			.open-btn.brand(@click='show = !show')
				//decision for svg
				span(:style="show ? 'display: block' : 'display: none'")
					i.fas.fa-times
				span(:style="show ? 'display: none' : 'display: block'")
					i.fas.fa-bars
			transition(name='live')
				.nav-panel(v-show='show')
					router-link.logo(to='/')
						img(src="/img/logo-big-blue.png" alt='Blagobud-logo')
					template( v-for='page in pages')
						router-link.nav-item(:key='page.name' :to='page.url') {{page.name}}
						router-link(v-if='page.children' v-for='child in page.children' :to='child.url' :key='child.url') {{child.name}}
					span
						i.fab.fa-viber.brand
						i.fab.fa-whatsapp.grass
						|{{meta.phone}}
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-header',
		props: ['view'],
		data() {
			return {
				children: null,
				listPos: null,
				show: false,
				logoStyles: {
					p: 5,
					h: 100
				}
			}
		},
		computed: {
			...mapState(['pages'])
		},
		methods: {
			showList(ch, event) {
				this.children = ch
				if (!ch) return
				let navList = 250
				let el = event.target
				this.listPos = el.offsetLeft + el.clientWidth/2 - navList/2
			},
			scroll() {
				if (window.scrollY > 100) {
					this.logoStyles = {
						p:3,
						h: 50
					}
				}
				else {
					this.logoStyles = {
						p: 5,
						h: 100
					}
				}
			}
		},
		watch: {
			'$route'() {
				this.show = null
			}
		},
		mounted() {
			window.onscroll = this.scroll
		}
	}
</script>

<style lang="scss" scoped src="@/scss/parts/header.scss"></style>