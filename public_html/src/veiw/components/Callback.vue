<template lang="pug">
	div
		template(v-if='simple')
			.bb-btn.brand.wide(@click='show = 1') Замовити консультацію
		template(v-else)
			.callback(@mouseenter='stop' @mouseleave='start' @click='show = phone' :style='"bottom: " + bottom + "px"')
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

				if (opt && !this.showPopup.phone) {
					alert('Введіть будь-ласка Ваш номер телефону');
					return
				}
				if (!opt && !this.showPopup.email) {
					alert('Вкажіть будь-ласка Ваш email');
					return
				}

				this.request({
					method: 'get',
					className: 'Contacts',
					methodName: 'sendRequest',
					opts
				})

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

<style lang="scss" scoped src="@/scss/components/callback.scss"></style>