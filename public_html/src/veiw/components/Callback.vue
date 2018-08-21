<template lang="pug">
	div
		.callback(@mouseenter='stop' @mouseleave='start' @click='show = phone')
			i.fas(:class="phone ? 'fa-phone' : 'fa-envelope'")
			| {{phone ? 'Замовте дзвінок' : 'Напишіть, що вас цікавить'}}
		.clearfix
		popup(v-if='show !== null' @close='show = null')
			template(slot='head') {{ show ? 'Ми зателефонуємо Вам на протязі 15 хвилин' : 'Напишіть, що Вас цікавить?'}}
			.form(slot='body')
				template(v-if='show')
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(v-model='showPopup.phone' placeholder='Вкажіть номер Вашого телефону')
				template(v-else)
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(v-model='showPopup.email' placeholder='Вкажіть Ваш email')
					input.input-field(v-model='showPopup.viber' placeholder='Вкажіть Ваш viber')
					input.input-field(v-model='showPopup.watsapp' placeholder='Вкажіть Ваш watsapp')
					textarea.input-field(v-model='showPopup.msg')
			div(slot='foot')
				.btn(@click='send(show)') Відправити
</template>

<script>
	export default {
		name: 'callback',
		data() {
			return {
				phone: 1,
				timer: null,
				show: null,
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
				console.log(1);
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

				if (opt && !this.showPopup.phone) {
					alert('Введіть будь-ласка Ваш номер телефону');
				}
				if (!opt && !this.showPopup.email) {
					alert('Вкажіть будь-ласка Ваш email');
				}

				this.request({
					method: 'get',
					className: 'Contacts',
					methodName: 'sendRequest',
					opts
				})
			}
		},
		mounted() {
			this.start()
		}
	}
</script>

<style lang="scss" scoped src="@/scss/components/callback.scss"></style>