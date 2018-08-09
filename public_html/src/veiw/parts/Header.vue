<template lang="pug">
	div
		.upheader
			a.logo(href='/')
				img(
					:src="require('@/img/brand/logo-big-blue.png')"
					alt='Blagobud-logo'
				)
			.address
				i.fas.fa-map-marked-alt
				span
					strong Адреса:<br>
					| {{contacts.city}}, {{contacts.street}}
			.time
				i.fas.fa-clock
				span
					strong Графік роботи:
					|<br> Пн-Cб з 8.00 до 18.00
			.phone
				i.fab.fa-viber.brand
				i.fab.fa-whatsapp.grass
				|{{contacts.phone}}
		.header(@mouseleave='children = null')
			.nav-panel
				.inner-wrapper.items-row
					a.nav-item(
					v-for='page in pages'
					:href='page.url'
					@mouseenter='showList(page.children, $event)'
					) {{page.name}}
						.after
			.nav-list(v-show='children' :style='"left: " + listPos + "px"')
				.arr
				.nav-item(v-for='child in children')
					a(:href='child.url') {{child.name}}
					.after
		.header-mob
			.open-btn(@click='show = !show')
				i.fas(:class='show ? "fa-times" : "fa-bars"')
			transition(name='live')
				.nav-panel(v-show='show')
					a.logo(href='/')
						img(:src="require('@/img/brand/logo-big-blue.png')" alt='Blagobud-logo')
					a.nav-item(v-for='page in pages' :href='page.url') {{page.name}}
					span
						i.fab.fa-viber.brand
						i.fab.fa-whatsapp.grass
						|{{contacts.phone}}
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
			...mapState(['pages', 'contacts'])
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

				console.log(this.logoStyles);
			}
		},
		mounted() {
			window.onscroll = this.scroll
		}
	}
</script>

<style lang="scss" scoped src="@/scss/parts/header.scss"></style>