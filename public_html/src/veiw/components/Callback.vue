<template lang="pug">
	div
		.callback(@mouseenter='stop' @mouseleave='start' @click='show = phone')
			i.fas(:class="phone ? 'fa-phone' : 'fa-envelope'")
			| {{phone ? 'Замовте дзвінок' : 'Напишіть, що вас цікавить'}}
		popup(v-if='show !== null' @close='show = null')
			template(slot='head') {{ show ? 'Ми зателефонуємо Вам на протязі 15 хвилин' : 'Напишіть, що Вас цікавить?'}}
			.form(slot='body')
				template(v-if='show')
					input.input-field(v-model='showPopup.name' placeholder="Вкажіть Ваше ім'я")
					input.input-field(v-model='showPopup.phone' placeholder='Вкажіть номер Вашого телефону')
				template(v-else)
					div 1
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
					phone: ''
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
				if (opt) {
					if (!this.showPopup.name || !this.showPopup.phone) {
						alert('Будь-ласка, заповніть всі поля!')
						return
					}

					this.request({
						method: 'get',
						className: 'Contacts',
						methodName: 'sendRequest',
						opts: this.showPopup
					})
				}
			}
		},
		mounted() {
			this.start()
		}
	}
</script>

<style lang="scss" scoped src="@/scss/components/callback.scss"></style>