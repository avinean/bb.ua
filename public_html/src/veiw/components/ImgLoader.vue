<template lang="pug">
	transition(name="appear")
		.img-loader
			.bg(@click='close')
			.img-loader-inner
				.loaded-img(
					v-if='uploadedPic'
					:style='"background-image: url(" + uploadedPic + ")"'
					)
					.btn.bg-lady.snow(@click='close') Відмінити
					.btn.bg-grass.snow(@click='close(uploadedPic)') Прийняти
				input(type='file' @change='onImgFileChanged')
				.fik-div Для завантаження натисніть тут
					br
					| або
					br
					| перетягніть сюди вашу картинку
</template>

<script>
	export default {
		name: 'img-loader',
		props: ['data'],
		data() {
			return {
				file: null,
				picData: null,
				uploadedPic: ''
			}
		},
		methods: {
			onImgFileChanged(e) {
				let file = e.target.files[0];
				this.uploadPhoto(file);
			},
			async uploadPhoto(file) {
				let form = new FormData;
				form.append('userpic', file);
				form.append('folder', this.data.folder);
				this.picData = form;

				this.uploadedPic = '';
				
				let res = await this.axios.post(
					'/secure/upload', 
					this.picData, 
					{headers: {'Content-Type': 'multipart/form-data'}}
					);
				this.uploadedPic = res.data;
			},
			close(url) {
				url = url.toUpperCase ? url : null;
				this.$emit('close', url)
			}
		}
	}
</script>

<style lang="scss" scoped>
	.img-loader {
		transition: all ease .3s;
		.bg {
			position: fixed;
			top: 0;
			right: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background: rgba(0,0,0,.7);
		}
		.img-loader-inner {
			width: 80vw;
			height: 80vh;
			margin: auto;

			.loaded-img {
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				margin: auto;
				z-index: 99999999999999999;
				width: 700px;
				height: 500px;
				display: flex;
				justify-content: center;
				align-items: center;
				background-size: contain;
				background-repeat: no-repeat;
				background-position: center;

				.btn {
					padding: 10px 30px;
					margin: 20px;
					cursor: pointer;
				}
			}

			input {
				position: absolute;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
				width: 700px;
				height: 500px;
				margin: auto;
			}

			.fik-div {
				position: absolute;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
				background: white;
				width: 700px;
				height: 500px;
				margin: auto;
				pointer-events: none;
				display: flex;
				align-items: center;
				justify-content: center;
				text-align: center;
				box-shadow: 0 0 12px 0 white;
			}
		}
	}
</style>