<template lang="pug">
	.catalog
		.inner-wrapper
			.content-block
				.divide-head Каталог
				p
					a(href='/catalog/pave') Тротуарні елементи
				p
					a(href='/catalog/road') Дорожні елементи
				p
					a(href='/catalog/vert') Вертикальні елементи
</template>

<script>
	import {mapState} from 'vuex'
	export default {
		name: 'page-catalog',
	}
</script>

<style lang="scss" scoped src="@/scss/pages/catalog.scss"></style>