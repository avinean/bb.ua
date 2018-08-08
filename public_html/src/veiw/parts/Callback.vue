<template lang="pug">
	div
		i.fas.fa-phone.call(@click='showPopup = {name:"", phone: ""}')
			.bg
		popup(v-if='showPopup' @close='showPopup = null')
			template(slot='head') Ми вам перетелефонуємо
			template(slot='body')
				p Залиште свої контакті дані і наші менеджери звяжуться з вами найближчим часом
				p.in(placeholder="Введіть ваше ім'я") Ваше ім'я:
					input(v-model='showPopup.name')
				p.in(placeholder="Введіть ваш телефон") Ваш телефон:
					input(v-model='showPopup.phone')
			template(slot='foot')
				btn.center(@click='send') Передзвонити
		a.fas.fa-phone.call(href='/contacts')
			.bg
</template>

<script>
	export default {
		name: 'callback',
		data() {
			return {
				showPopup: null
			}
		},
		methods: {
			send() {
				if (!this.showPopup.name || !this.showPopup.phone) {
					alert('Будь-ласка, заповніть всі поля!')
					return
				}
				let params = this.showPopup
				params['req'] = 'call';
				this.axios('/contacts/callback', {params})
				this.showPopup = null
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/parts/callback.scss"></style>