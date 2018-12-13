<template lang="pug">
	transition(name="appear")
		.text-editor
			.panel
				.toolbar(v-if="!pure")
					<!--select(v-model='format' @change="formatDoc('formatblock', format)")-->
						<!--option(selected) Форматування-->
						<!--option(v-for='v,k in formats' :value='k') {{v}}-->
					<!--select(v-model='font' @change="formatDoc('fontname', font)")-->
						<!--option(selected) Шрифт-->
						<!--option(v-for='v,k in fonts' :value='v') {{v}}-->
					select(v-model='fontsize' @change="formatDoc('fontsize', fontsize)")
						option(selected) Розмір шрифта
						option(v-for='v,k in fontsizes' :value='k') {{v}}
					<!--select(v-model='lineheight' @change="formatLineHeight")-->
						<!--option(selected) Висота строки-->
						<!--option(v-for='v,k in lineheights' :value='k') {{v}}-->
					<!--select(v-model='forecolor' @change="formatDoc('forecolor', forecolor)")-->
						<!--option(selected) Колір тексту-->
						<!--option(v-for='v,k in forecolors' :value='k') {{v}}-->
					<!--select(v-model='backcolor' @change="formatDoc('backcolor', backcolor)")-->
						<!--option(selected) Фон тексту-->
						<!--option(v-for='v,k in backcolors' :value='k') {{v}}-->
					<!--button.fas.fa-undo(@click.prevent="formatDoc('undo')")-->
					<!--button.fas.fa-redo(@click.prevent="formatDoc('redo')")-->
					button(@click.prevent="formatDoc('removeFormat')"): .fas.fa-eraser.brand
					button(@click.prevent="formatDoc('bold')"): .fas.fa-bold.brand
					button(@click.prevent="formatDoc('italic')"): .fas.fa-italic.brand
					button(@click.prevent="formatDoc('underline')"): .fas.fa-underline.brand
					button(@click.prevent="formatDoc('justifyleft')"): .fas.fa-align-left.brand
					button(@click.prevent="formatDoc('justifycenter')"): .fas.fa-align-center.brand
					button(@click.prevent="formatDoc('justifyright')"): .fas.fa-align-right.brand
					button(@click.prevent="formatDoc('insertorderedlist')"): .fas.fa-list-ol.brand
					button(@click.prevent="formatDoc('insertunorderedlist')"): .fas.fa-list-ul.brand
					<!--button.fas.fa-quote-right(@click.prevent="formatDoc('formatblock','blockquote')")-->
					button(@click.prevent="formatDoc('outdent')"): .fas.fa-outdent.brand
					button(@click.prevent="formatDoc('indent')"): .fas.fa-indent.brand
					button(@click.prevent="createLink()"): .fas.fa-link.brand
					button(@click.prevent="createImg"): .fas.fa-image.brand
					<!--button.fas.fa-image(@click.prevent="insetImg")-->
					<!--button.fas.fa-cut(@click.prevent="formatDoc('cut')")-->
					<!--button.fas.fa-copy(@click.prevent="formatDoc('copy')")-->
					<!--button.fas.fa-file-word(@click.prevent="formatDoc('paste')")-->
					button(@click.prevent="pasteFromWord"): .fas.fa-file-word.brand
				.closebar
					button.snow.bg-grass(@click='close(1)')
						i.far.fa-save.brand
						| &#32;&#32;&#32;&#32;Зберегти
					button.snow.bg-lady(@click='close(0)')
						i.far.fa-close.brand
						| &#32;&#32;&#32;&#32;Закрити без збереження
						transition(name='appear')
			.sub-panel(v-if='curImg')
				.toolbar Редагувати розміри картинки:
					span
						label Висота:
						input.heigt(type='number' v-model='curImg.height' @keypress.enter="curImg.customResolve")
					span
						label Ширина:
						input.width(type='number' v-model='curImg.width' @keypress.enter="curImg.customResolve")
				.closebar
					button.snow.bg-grass(@click="curImg.customResolve")
						i.far.fa-save.brand
						| &#32;&#32;&#32;&#32;Зберегти
					button.snow.bg-lady(@click='curImg.customReject')
						i.far.fa-close.brand
						| &#32;&#32;&#32;&#32;Закрити без збереження
			div.screen
				.inner-wrapper(ref='editor' contenteditable v-html='value' @click='cursorClick')
			transition(name='appear')
				img-loader(v-if='imgData.action' @close='imgData.action' :data='imgData')
			transition(name='appear')
				popup(v-if="asyncObj.resolve" @close="asyncObj.resolve")
					div(contenteditable style="width: 1000px; height: 500px; overflow-y: scroll;" slot="body" ref="wordclear")
					button.bb-btn.brand(slot="foot" @click="asyncObj.resolve") Вставити
</template>

<script>
	export default {
		name: 'text-editor',
		props: ['value', 'pure'],
		data() {
			return {
				asyncObj: {
					text: '',
					resolve: null
				},
				curImg: null,
				imgData: {
					folder: '.',
					action: null
				},
				format: '',
				formats: {
					h1: 'Заголовок 1 <h1>',
					h2: 'Заголовок 2 <h2>',
					h3: 'Заголовок 3 <h3>',
					h4: 'Заголовок 4 <h4>',
					h5: 'Заголовок 5 <h5>',
					h6: 'Підзаголовок <h6>',
					p: 'Параграф <p>',
					pre: 'Неформатований текст <pre>',
				},
				lineheight: '',
				lineheights: {
					'100%': 100,
					'150%': 150,
					'200%': 200,
					'250%': 250,
					'300%': 300,
				},
				font: '',
				fonts: [
					'Arial',
					'Arial Black',
					'Courier New',
					'Times New Roman',
				],
				fontsize: '',
				fontsizes: {
					1: 'Мінімальний',
					2: 'Маленький',
					3: 'Менший',
					4: 'Середній',
					5: 'Більший',
					6: 'Великий',
					7: 'Максимальний',
				},
				forecolor: '',
				forecolors: {
					red: 'Red',
					blue: 'Blue',
					green: 'Green',
					black: 'Black',
				},
				backcolor: '',
				backcolors: {
					red: 'Red',
					green: 'Green',
					black: 'Black',
				}
			}
		},
		methods: {
			formatDoc(cmd, val) {
				window.document.execCommand(cmd, false, val);
				this.fontsize = '';
				this.lineheight = '';
			},
			createLink() {
				let link = prompt('Write the URL here','http:\/\/')

				if(link && link != '' && link != 'http://'){
					this.formatDoc('createlink', link)
				}
			},
			async createImg() {
				window.document.execCommand('insertImage', true, 'tmp.jpg');

				let url = await new Promise((resolve, reject) => {
					this.imgData.action = resolve;
				});

				if (url) {
					this.$refs.editor.innerHTML = this.$refs.editor.innerHTML.replace(/<img src="tmp\.jpg".*?>/, `<img src="${url}">`);
				}
				else {
					this.$refs.editor.innerHTML = this.$refs.editor.innerHTML.replace(/<img src="tmp\.jpg".*?>/, '');
				}

				this.imgData.action = null;
			},
			async pasteFromWord() {
				document.execCommand('insertImage', true, '$$WORD_INSERTION$$');
				await new Promise((resolve, reject) => {
					this.asyncObj.resolve = resolve;
				});
				let text = this.$refs.wordclear.innerText;
				console.log(text);
				text = text.replace(/\n/ig, '<br>');
				this.$refs.editor.innerHTML = this.$refs.editor.innerHTML.replace(/<img src="\$\$WORD_INSERTION\$\$".*?>/, text);
				this.$refs.editor.innerHTML = this.$refs.editor.innerHTML.replace(/<pre .+?>|<\/pre>/, '');
				this.asyncObj.resolve = null;
			},
			async cursorClick(e) {
				if (e.target.tagName === 'IMG') {
					// e.target.style.border = "2px dashed grey";
					this.curImg = e.target;
					await new Promise((res, rej) => {
						this.curImg.customResolve = res;
						this.curImg.customReject = rej;
						// this.curImg.onblur = () => {
						// 	this.curImg.style.border = "none";
						// 	this.curImg = null;
						// }
					})
					.then(_ => {
						this.curImg = null;
					}).catch(_ => {
						this.curImg = null;
					})
				}
			},
			close(mode) {
				let html = this.$refs.editor.innerHTML;
				if (this.pure) html = this.$refs.editor.innerText;
				this.$emit('close', mode ? {html} : null)
			}
		}
	}
</script>

<style lang="scss" scoped>
	@import "@/scss/var.scss";

	.text-editor {
		width: 100vw;
		height: 100vh;
		position: fixed;
		transition: all ease .3s;

		.panel, .sub-panel {
			display: flex;
			align-items: center;
			justify-content: space-between;
			height: 50px;
			padding: 0 20px;
			background: #ece7e7;
			box-shadow: inset 0 0 17px -6px;

			button {
				padding: 6px 8px;
				color: $brand;
				cursor: pointer;
			}

			select {
				height: 26px;
				width: 150px;
				font-size: 17px;
			}

			.closebar {
				&>button {
					border: none;
					&>i {
						color: $snow;
					}
				}
			}
		}

		.sub-panel {
			height: 30px;

			button {
				padding: 2px 6px;
				color: $cherry;
			}

			input {
				width: 100px;
    			margin: 0 20px;
			}
		}

		.screen {
			display: block;
			background: rgba(0,0,0,.7);
			height: 100vh;
			width: 100vw;
			padding: 20px;

			.inner-wrapper {
				box-shadow: 0 0 2px 0 grey;
				overflow-y: scroll;
				max-height: calc(100vh - 200px);
				padding: 20px 0 50px;
				background: white;
			}
		}

		.image-editor {
			background: white;
			box-shadow: 0 0 10px 0;
			padding: 20px;
			text-align: center;
		}
	}
</style>