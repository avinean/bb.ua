<template lang="pug">
	.footer
		.inner-wrapper
			.footer-body
				.contacts.logo
					.logo-top
						img.logo(src='/img/logo-white.png' alt='Blagobud-logo')
						.addr
							span У НАС Є РІШЕННЯ САМЕ ДЛЯ ВАС
					.logo-bot
						.addr
							span ЄДРПОУ {{meta.edrpou}}
						.addr
							span ІПН {{meta.inn}}
				.contacts.links
					p.header1 Приєднуйтесь до нас в соціальних мережах
					.addr
						a.facebook-link(href='https://www.facebook.com/vkblagobud' target='_blank')
							svg(
								aria-hidden="true"
								data-prefix="fab"
								data-icon="facebook"
								class="svg-inline--fa fa-facebook fa-w-14"
								role="img"
								xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 448 512"
							)
								path(
									d="M448 56.7v398.5c0 13.7-11.1 24.7-24.7 24.7H309.1V306.5h58.2l8.7-67.6h-67v-43.2c0-19.6 5.4-32.9 33.5-32.9h35.8v-60.5c-6.2-.8-27.4-2.7-52.2-2.7-51.6 0-87 31.5-87 89.4v49.9h-58.4v67.6h58.4V480H24.7C11.1 480 0 468.9 0 455.3V56.7C0 43.1 11.1 32 24.7 32h398.5c13.7 0 24.8 11.1 24.8 24.7z"
								)
					p.header1 Виробнича компанія "Благобуд" входить до групи компаній
					.addr
						a.partner(href='http://www.promenad.ua/' target='_blank')
							img(src='/img/partners/promenad.png' alt='promenad')
				.contacts.info
					p.header1 КОНТАКТИ
					.addr
						span.ico
							i.fas.fa-map-marker-alt.brand
						span.title Адреса: {{meta.region}}, <br>{{meta.district}}
							|, {{meta.city}}, <br> {{meta.street}}
					.addr
						span.ico
							i.fas.fa-phone.brand
						span.title {{meta.phone}}
					.addr
						span.ico
							i.fas.fa-envelope.brand
						a.title(:href='"mailto:" + meta.email') {{meta.email}}
					.addr
						span.ico
							i.fas.fa-map-marked-alt.brand
						a.title(href='https://www.google.com/maps/dir//%D0%A2%D0%9E%D0%92+%22%D0%92%D0%9A+%22%D0%91%D0%9B%D0%90%D0%93%D0%9E%D0%91%D0%A3%D0%94%22/data=!4m8!4m7!1m0!1m5!1m1!1s0x40d4cb932c18e567:0x63292aa8267936d0!2m2!1d30.242010399999998!2d50.394196199999996') Прокласти маршрут
		.footer-foot
			.inner-wrapper
				div Усі права захищені © 2015-{{new Date().getFullYear()}}
				div
					router-link(to='/policy') Політика конфіденційності
				div
					a.logo-brig(href='https://avinean.github.io')
						img(src='/img/brig.png')
						.title BRIG Studio
		a.admin-gate.brand(href='/admin')
			i.fas.fa-door-open
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-footer',
		data() {
			return {
				partners: [
					{img: '/img/partners/metalbud.jpg', url: '/', h: 'height: 30px'},
					{img: '/img/partners/planeta.png', url: '/', h: 'height: 30px'},
					{img: '/img/partners/prombud.png', url: '/', h: 'height: 30px'},
					{img: '/img/partners/promenad.png', url: '/', h: 'height: 30px'},
					{img: '/img/partners/smile.png', url: '/', h: 'height: 30px'},
					{img: '/img/partners/budtemp.png', url: '/', h: 'height: 50px'},
					{img: '/img/partners/barberry.jpg', url: '/', h: 'height: 50px'},
					{img: '/img/partners/kanbud.png', url: '/', h: 'height: 50px'},
					{img: '/img/partners/kirpich.jpg', url: '/', h: 'height: 50px'},
				]
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/parts/footer.scss"></style>