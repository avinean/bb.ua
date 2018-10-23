<template lang="pug">
	.footer
		.footer-body
			.contacts.logo
				img.logo(src='/img/logo-white.png' alt='Blagobud-logo')
				.addr
					span У НАС Є РІШЕННЯ САМЕ ДЛЯ ВАС!
				br
				.addr
					span ЄДРПОУ {{contacts.edrpou}}
				.addr
					span ІНН {{contacts.inn}}
			.contacts.links
				p.header1 Приєднуйтесь до нас в соціальних мережах
				.addr
					a.fab.fa-facebook(href='https://www.facebook.com/vkblagobud' target='_blank')
				p.header1 Виробнича компанія "Благобуд" входить до групи компаній
				.addr
					a.partner(href='http://www.promenad.ua/' target='_blank')
						img(src='/img/partners/promenad.png' alt='promenad')
			.contacts.info
				p.header1 КОНТАКТИ
				.addr
					i.fas.fa-map-marker-alt
					span.title Адреса: {{contacts.region}}, <br>{{contacts.district}}
						|, {{contacts.city}}, <br> {{contacts.street}}
				.addr
					i.fas.fa-phone
					span.title {{contacts.phone}}
				.addr
					i.fas.fa-envelope
					a.title(:href='"mailto:" + contacts.email') {{contacts.email}}
				.addr
					i.fas.fa-map-marked-alt
					a.title(href='https://www.google.com/maps/dir//%D0%A2%D0%9E%D0%92+%22%D0%92%D0%9A+%22%D0%91%D0%9B%D0%90%D0%93%D0%9E%D0%91%D0%A3%D0%94%22/data=!4m8!4m7!1m0!1m5!1m1!1s0x40d4cb932c18e567:0x63292aa8267936d0!2m2!1d30.242010399999998!2d50.394196199999996') Прокласти маршрут
		.footer-foot
			div Усі права захищені © 2015-2018
			div 
				a(href='/store/confidence.pdf') Політика конфіденційності
			div 
				a.logo-brig(href='https://avinean.github.io')
					img(src='/img/brig.png')
					.title BRIG Studio
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
		},
		computed: {
			...mapState(['contacts'])
		},
	}
</script>

<style lang="scss" scoped src="@/scss/parts/footer.scss"></style>