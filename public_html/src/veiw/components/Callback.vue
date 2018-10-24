<template lang="pug">
	div.callback-wrap
		template(v-if='simple')
			.bb-btn.brand.wide(@click='show = 1') Замовити консультацію
		template(v-else)
			.callback.bg-brand(@mouseenter='stop' @mouseleave='start' @click='show = phone' :style='"bottom: " + bottom + "px"')
				transition(name='fade')
					p.cherry.fas.fa-phone(v-if='phone')
					p.cherry.fas.fa-envelope(v-else)
				p.title {{phone ? 'Замовте дзвінок' : 'Напишіть, що вас цікавить'}}
			<!--.clearfix-->
		popup(v-if='show !== null' @close='show = null')
			template(slot='head') {{ show ? 'Ми зателефонуємо Вам на протязі 15 хвилин' : 'Напишіть, що Вас цікавить?'}}
			.form(slot='body')
				template(v-if='show')
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(v-model='showPopup.phone' placeholder='Вкажіть номер Вашого телефону')
				template(v-else)
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(v-model='showPopup.email' placeholder='Вкажіть Ваш e-mail')
					input.input-field(v-model='showPopup.viber' placeholder='Вкажіть Ваш viber\watsapp')
					textarea.input-field(v-model='showPopup.msg')
			div(slot='foot')
				.bb-btn.cherry(@click='send(show)') Відправити
</template>

<script>
	export default {
		name: 'callback',
		props: ['simple'],
		data() {
			return {
				phone: 1,
				timer: null,
				show: null,
				bottom: 0,
				showPopup: {
					name: '',
					phone: '',
					msg: '',
					viber: '',
					watsapp: '',
					email: ''
				}
			}
		},
		methods: {
			stop() {
				clearTimeout(this.timer)
			},
			start() {
				this.timer = setTimeout(this.circ, 3000)
			},
			circ() {
				this.phone = !this.phone
				this.timer = setTimeout(this.circ, 3000)
			},
			send(opt) {
				let opts = this.showPopup;
				opts.type = opt;

				if (opt && !this.showPopup.phone && !this.showPopup.name) {
					alert('Будь-ласка, заповніть всі поля!');
					return
				}
				if (!opt && !this.showPopup.email && !this.showPopup.name) {
					alert('Будь-ласка, заповніть всі поля!');
					return
				}

				this.request({
					method: 'get',
					className: 'Contacts',
					methodName: 'sendRequest',
					opts
				})

				this.show = null;

				this.$parent.showMessage = `
					Дякуємо! 
					<br> Ваш запит відправлено
				`
				setTimeout(e => this.$parent.showMessage = null, 4000)
			},
			scroll() {
				let b = document.scrollingElement.offsetHeight - document.scrollingElement.scrollTop - document.scrollingElement.clientHeight;
				this.bottom = b < 300 ? 300 - b : 0
			}
		},
		mounted() {
			if (!this.simple) {
				this.start()
				window.addEventListener('scroll', this.scroll)
			}			
		}
	}
</script>

<style lang="scss" scoped>
	@import "@/scss/var.scss";

	.callback {
		width: 334px;
		height: 68px;
		border-radius: 10px;
		display: flex;
		align-items: center;
		float: right;
		padding: 10px;
		cursor: pointer;
		color: white;
		position: fixed;
		bottom: 0;
		right: 0;
		z-index: 1;

		.fas {
			font-size: 28px;
			background: white;
			padding: 10px;
			border-radius: 100%;
			margin: 0 10px;
			transition: all ease .5s;
		}

		.title {
			font-size: 15px;
			color: $snow;
		}

		@media screen and (max-width: 760px) {
			display: none;
		}
	}

	.input-field {
		display: block;
		width: 80%;
		height: 40px;
		margin: 20px auto;
		padding: 10px;
		font-style: italic;
	}

	textarea.input-field {
		height: 200px;
	}
</style>