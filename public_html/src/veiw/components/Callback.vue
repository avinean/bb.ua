<template lang="pug">
	div.callback-wrap
		template(v-if='simple')
			.bb-btn.brand.wide(@click='show = 1') Замовити консультацію
		template(v-else)
			.callback.bg-brand(
				@mouseenter='stop'
				@mouseleave='start'
				@click='show = phone'
				:style='"bottom: " + bottom + "px; transition: all ease .1s"'
			)
				transition(name='fade')
					p.cherry.fas.fa-phone.bg-snow(v-if='phone')
					p.cherry.fas.fa-envelope.bg-snow(v-else)
				p.title.snow {{phone ? 'Замовте дзвінок' : 'Напишіть, що вас цікавить'}}
		popup(v-if='show !== null' @close='show = null')
			template(slot='head') {{ show ? 'Ми зателефонуємо Вам на протязі 15 хвилин' : 'Напишіть, що Вас цікавить?'}}
			.form(slot='body')
				template(v-if='show')
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(
						v-model='showPopup.phone'
						placeholder='Вкажіть номер Вашого телефону'
						type='tel'
					)
				template(v-else)
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(
						v-model='showPopup.email'
						placeholder='Вкажіть Ваш e-mail'
						type='email'
					)
					input.input-field(v-model='showPopup.viber' placeholder='Вкажіть Ваш Viber\\WhatsApp')
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
				this.phone = !this.phone;
				this.timer = setTimeout(this.circ, 3000)
			},
			send(opt) {
				let opts = this.showPopup;
				opts.type = opt;

				if (opt && !this.showPopup.phone && !this.showPopup.name) {
					return alert('Будь-ласка, заповніть всі поля!');
				}
				if (!opt && !this.showPopup.email && !this.showPopup.name) {
					return alert('Будь-ласка, заповніть всі поля!');
				}
				if (opt && !this.isValidPhone(this.showPopup.phone)) {
					return alert('Ви ввели недійсний номер телефону!');
				}
				if (!opt && !this.isValidEmail(this.showPopup.email)) {
					return alert('Ви ввели недійсний e-mail!');
				}
				if (!opt && !this.isValidPhone(this.showPopup.viber)) {
					return alert('Ви ввели недійсний номер телефону!');
				}

				this.request({
					method: 'get',
					className: 'Contacts',
					methodName: 'sendRequest',
					opts
				});

				this.show = null;

				this.showPopup = {
					name: '',
					phone: '',
					msg: '',
					viber: '',
					watsapp: '',
					email: ''
				};

				this.showInfoMessage(`Дякуємо! <br> Ваш запит відправлено`, 4000, null, true);
			},
			scroll() {
				let b = window.document.scrollingElement.offsetHeight - window.document.scrollingElement.scrollTop - window.document.scrollingElement.clientHeight;
				this.bottom = b < 300 ? 300 - b : 0
			}
		},
		mounted() {
			if (!this.simple) {
				this.start();
				window.addEventListener('scroll', this.scroll)
			}			
		},
		watch: {
			'$route'() {
				this.bottom = 0;
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
		position: fixed;
		bottom: 0;
		right: 0;
		z-index: 1;

		svg {
			font-size: 49px;
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