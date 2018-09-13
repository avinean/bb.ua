<template lang="pug">
	.img-loader
		i.close.fas.fa-times.main(@click='close')
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
				this.picData = form;

				this.uploadedPic = '';
				
				let res = await this.axios.post(
					'/secure/upload', 
					this.picData, 
					{headers: {'Content-Type': 'multipart/form-data'}}
					)
				this.uploadedPic = res.data;
			},
			close(url) {
				url = url.toUpperCase ? url : null
				this.$emit('close', url)
			}
		}
	}
</script>

<style lang="scss" scoped>
	.img-loader {
		position: fixed;
		z-index: 9999;
		bottom: 0;
		left: 0;
		right: 0;
		top: 0;
		width: 80vw;
		height: 80vh;
		margin: auto;

		.close {
			position: absolute;
			right: 10px;
			top: 10px;
			z-index: 3;
			font-size: 20px;
			cursor: pointer;
		}

		.loaded-img {
			position: absolute;
			z-index: 1;
			width: 100%;
			height: 100%;
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
    		width: 100%;
		}

		.fik-div {
			position: absolute;
			top: 0;
			background: white;
			width: 100%;
			bottom: 0;
			pointer-events: none;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			border: dashed;
		}
	}
</style>