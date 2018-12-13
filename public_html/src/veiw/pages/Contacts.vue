<template lang="pug">
	.contacts
		.inner-wrapper.content
			.content-block
				.divide-head Наші контакти
				.send-form
					.contacts-list
						p
							transition(name="jump")
								label(v-show="name") Ваше ім'я
							input(v-model='name' placeholder="Ваше ім'я")
						p.cen
							transition(name="jump")
								label(v-show="phone") Ваш телефон
							input(v-model='phone' placeholder='Ваш телефон')
						p
							transition(name="jump")
								label(v-show="email") Ваш e-mail
							input(v-model='email' placeholder='Ваш e-mail')
					p: textarea(v-model='msg' placeholder='Ваше повідомлення')
					.bb-btn.brand(@click='send') Відправити
		iframe.map(
			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2543.5173033518304!2d30.23982171572933!3d50.394196179467684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cb932c18e567%3A0x63292aa8267936d0!2z0KLQntCSICLQktCaICLQkdCb0JDQk9Ce0JHQo9CUIg!5e0!3m2!1sen!2sua!4v1534780179207" 
			height="450" 
			frameborder="0" 
			style="border:0; width: 100%"
			allowfullscreen
			)
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-contacts',
		data() {
			return {
				email: '',
				msg: '',
				name: '',
				phone: ''
			}
		},
		methods: {
			async send() {
				if (!this.name || !this.email || !this.msg || !this.phone) {
					return alert('Будь-ласка, заповніть всі поля!');
				}

				if (!this.isValidEmail(this.email)) {
					return alert('Ви ввели недійсний e-mail!');
				}

				if (!this.isValidPhone(this.phone)) {
					return alert('Ви ввели недійсний номер телефону!');
				}

				let res = await this.request({
					method: 'get',
					className: 'Contacts',
					methodName: 'sendMessage',
					opts: {
						email: this.email,
						msg: this.msg,
						phone: this.phone,
						name: this.name,
					}
				});

				this.email = '';
				this.msg = '';
				this.phone = '';
				this.name = '';

				this.showInfoMessage(
					`
						Дякуємо!
						<br> Звернення передано до Вашого персонального менеджера.
						<br> На протязі 15 хвилин з Вами зв’яжуться
					`
					, 5000, null, true);
			}
		},
		mounted() {
			
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/contacts.scss"></style>