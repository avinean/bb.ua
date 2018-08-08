<template lang="pug">
	.contacts
		.inner-wrapper.content
			.content-block
				h3 Наші контакти
				.content-section
					p.addr
						i.fas.fa-hotel
						span ТОВ "ВК "Благобуд""
					p.addr
						i.fas.fa-phone
						span {{contacts.phone}}
					p.addr
						i.fas.fa-envelope
						span
							a.mailto(:href='"mailto:" + contacts.email') {{contacts.email}}
					p.addr
						i.fas.fa-map-marked-alt
						span {{contacts.country}}, {{contacts.region}}, {{contacts.city}},<br>{{contacts.street}}, {{contacts.index}}
				.send-form
					h2 Напишіть нам
					p: input(v-model='name' placeholder="Ваше ім'я")
					p: input(v-model='email' placeholder='Ваш email')
					p: textarea(v-model='msg' placeholder='Ваше повідомлення')
					btn.btn(@click='send') Відправити
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-contacts',
		data() {
			return {
				email: '',
				msg: '',
				name: ''
			}
		},
		computed: {
			...mapState(['contacts'])
		},
		methods: {
			send() {
				if (!this.name || !this.email || !this.msg) {
					alert('Будь-ласка, заповніть всі поля!')
					return
				}
				let params = {
					email: this.email,
					msg: this.msg,
					name: this.name,
				};
				this.axios('/contacts/send-msg', {params})
			}
		}
	}
</script>

<style lang="scss" scoped src="@/scss/pages/contacts.scss"></style>