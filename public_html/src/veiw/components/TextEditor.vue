<template lang="pug">
	.text-editor
		.panel
			.toolbar
				<!--select(v-model='format' @change="formatDoc('formatblock', format)")-->
					<!--option(selected) Форматування-->
					<!--option(v-for='v,k in formats' :value='k') {{v}}-->
				<!--select(v-model='font' @change="formatDoc('fontname', font)")-->
					<!--option(selected) Шрифт-->
					<!--option(v-for='v,k in fonts' :value='v') {{v}}-->
				select(v-model='fontsize' @change="formatDoc('fontsize', fontsize)")
					option(selected) Розмір шрифта
					option(v-for='v,k in fontsizes' :value='k') {{v}}
				select(v-model='lineheight' @change="formatLineHeight")
					option(selected) Висота строки
					option(v-for='v,k in lineheights' :value='k') {{v}}
				<!--select(v-model='forecolor' @change="formatDoc('forecolor', forecolor)")-->
					<!--option(selected) Колір тексту-->
					<!--option(v-for='v,k in forecolors' :value='k') {{v}}-->
				<!--select(v-model='backcolor' @change="formatDoc('backcolor', backcolor)")-->
					<!--option(selected) Фон тексту-->
					<!--option(v-for='v,k in backcolors' :value='k') {{v}}-->
				<!--button.fas.fa-undo(@click.prevent="formatDoc('undo')")-->
				<!--button.fas.fa-redo(@click.prevent="formatDoc('redo')")-->
				button.fas.fa-eraser(@click.prevent="formatDoc('removeFormat')")
				button.fas.fa-bold(@click.prevent="formatDoc('bold')")
				button.fas.fa-italic(@click.prevent="formatDoc('italic')")
				button.fas.fa-underline(@click.prevent="formatDoc('underline')")
				button.fas.fa-align-left(@click.prevent="formatDoc('justifyleft')")
				button.fas.fa-align-center(@click.prevent="formatDoc('justifycenter')")
				button.fas.fa-align-right(@click.prevent="formatDoc('justifyright')")
				button.fas.fa-list-ol(@click.prevent="formatDoc('insertorderedlist')")
				button.fas.fa-list-ul(@click.prevent="formatDoc('insertunorderedlist')")
				<!--button.fas.fa-quote-right(@click.prevent="formatDoc('formatblock','blockquote')")-->
				button.fas.fa-outdent(@click.prevent="formatDoc('outdent')")
				button.fas.fa-indent(@click.prevent="formatDoc('indent')")
				button.fas.fa-link(@click.prevent="createLink()")
				<!--button.fas.fa-image(@click.prevent="loadImg = {folder:'.'}")-->
				<!--button.fas.fa-cut(@click.prevent="formatDoc('cut')")-->
				<!--button.fas.fa-copy(@click.prevent="formatDoc('copy')")-->
				<!--button.fas.fa-paste(@click.prevent="formatDoc('paste')")-->
			.closebar
				button(@click='close(1)')
					i.far.fa-save.brand
					| &#32;&#32;&#32;&#32;Зберегти
				button(@click='close(0)')
					i.far.fa-slose.brand
					| &#32;&#32;&#32;&#32;Закрити без збереження
		div.screen(ref='editor' contenteditable v-html='value')
		transition(name='appear')
			img-loader(v-if='loadImg' @close='imgLoaded' :data='loadImg')
</template>

<script>
	export default {
		name: 'text-editor',
		props: ['value'],
		data() {
			return {
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
				},
				loadImg: null
			}
		},
		methods: {
			formatDoc(cmd, val) {
				window.document.execCommand(cmd, false, val);
				this.fontsize = '';
				this.lineheight = '';
			},
			formatLineHeight() {
				console.log(window.getSelection());

				this.fontsize = '';
				this.lineheight = '';
			},
			createLink() {
				let link = prompt('Write the URL here','http:\/\/')

				if(link && link != '' && link != 'http://'){
					this.formatDoc('createlink', link)
				}
			},
			imgLoaded(e) {
				if (e) {
					let link = e.replace(/\/\.\//, '/');
					this.formatDoc('insertImage', link);
				}
				this.loadImg = null
			},
			close(mode) {
				let html = this.$refs.editor.innerHTML;
				this.$emit('close', mode ? {html} : null)
			}
		},
		mounted() {
			// window.document.execCommand('styleWithCSS', true);
		}
	}
</script>

<style lang="scss" scoped>
	@import "@/scss/var.scss";

	.text-editor {
		width: 100vw;
		height: 100vh;
		position: fixed;

		.panel {
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
				}

				select {
					height: 26px;
					width: 150px;
				font-size: 17px;
			}
		}

		.screen {
			display: block;
			background: white;
			height: 100vh;
			width: 100vw;
			padding: 20px;
			overflow-y: scroll;
		}
	}
</style>