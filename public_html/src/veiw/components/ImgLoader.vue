<template lang="pug">
	.img-loader
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
				
				let res = await this.admin(
						{
							methodName: 'uploadImg',
							opts: {form}
						}, 
						{
							'Content-Type': 'multipart/form-data'
						}
					)

console.log(1);

			},
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