<template lang="pug">
	.footer
		.footer-body
			.logo
				img(:src="require('@/img/brand/logo-big-blue.png')" alt='Blagobud-logo')
			.nav
				h2 Меню
				.items-block(v-for='page in pages' )
					a.footer-nav-item(:href='page.url') {{page.name}}
					div(v-if='page.children')
						p(v-for='child in page.children')
							a.footer-nav-subitem(:href='child.url') {{child.name}}
			.contacts
				h2 Контакти
				.addr
					i.fas.fa-hotel
					span ТОВ "ВК "Благобуд""
				.addr
					i.fas.fa-phone
					span {{contacts.phone}}
				.addr
					i.fas.fa-envelope
					span
						a.mailto(:href='"mailto:" + contacts.email') {{contacts.email}}
				.addr
					i.fas.fa-map-marked-alt
					span {{contacts.region}}, {{contacts.city}}, {{contacts.street}}
				.addr
					a(href='https://www.google.com/maps/dir//%D0%A2%D0%9E%D0%92+%22%D0%92%D0%9A+%22%D0%91%D0%9B%D0%90%D0%93%D0%9E%D0%91%D0%A3%D0%94%22/data=!4m8!4m7!1m0!1m5!1m1!1s0x40d4cb932c18e567:0x63292aa8267936d0!2m2!1d30.242010399999998!2d50.394196199999996') Прокласти маршрут
			.links
				<!--i.zmdi.zmdi-google-plus-box-->
				a(href='https://www.facebook.com/vkblagobud/ ')
					i.zmdi.zmdi-facebook-box
				<!--i.zmdi.zmdi-share-->
				<!--i.zmdi.zmdi-youtube-play-->
		.inner-wrapper
			.footer-foot
				div
					p Усі права захищені © 2015-2018
					p Використання матеріалів з сайту тільки з дозволу адміністрації сайту

				div Сайт розроблений <br>студією AvineanDev
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-footer',
		data() {
			return {
				children: null
			}
		},
		computed: {
			...mapState(['pages', 'contacts'])
		},
	}
</script>

<style lang="scss" scoped src="@/scss/parts/footer.scss"></style>