<template lang="pug">
	transition(name="appear")
		.popup
			.popup-bg(@click='close')
			.popup-wrap
				.head
					.title
						slot(name='head')
					i.fas.fa-times.close.snow(@click='close')
				.body
					slot(name='body')
				.foot(v-if="!nofooter")
					slot(name='foot')
</template>

<script>
	export default {
		name: 'popup',
		props: ['nofooter'],
		methods: {
			close() {
				this.$emit('close');
			}
		}
	}
</script>

<style lang="scss" scoped>
	@import "@/scss/var.scss";
	@import "@/scss/mixin.scss";

	.popup {
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: 9999;
		display: flex;
		justify-content: space-around;
		align-items: center;
		width: 100vw;
		height: 100vh;
		transition: all ease .3s;

		.popup-bg {
			position: absolute;
			width: 100vw;
			height: 100vh;
			background-color: rgba(100,100,100,.5);
		}

		.popup-wrap {
			position: absolute;
			min-width: 400px;
			display: flex;
			flex-direction: column;
			background: #fff;

			.head {
				flex-basis: 40px;
				position: relative;
				background-color: $brand;
				color: $snow;

				.title {
					position: absolute;
					top: 11px;
					left: 11px;
					bottom: 11px;
					min-width: 90%;
					font-size: 14px;
					color: $snow;
				}

				.close {
					position: absolute;
					top: 11px;
					right: 11px;
					bottom: 11px;
					cursor: pointer;
				}
			}

			.body {
				flex: auto;
				padding: 10px;
			}

			.foot {
				flex-basis: 60px;
				width: 100%;
			}

			@media screen and (max-width: 450px) {
				position: fixed;
				width: 100%;
			}
		}
	}
</style>