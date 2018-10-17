<template lang="pug">
	.text-editor
		.panel
		<!--general formatting h1, h2, h3-->
			select(v-model='format' @change="formatDoc('formatblock', format)")
				option(selected) Форматування
				option(v-for='v,k in formats' :value='k') {{v}}
		<!--Font style-->
			select(v-model='font' @change="formatDoc('fontname', font)")
				option(selected) Шрифт
				option(v-for='v,k in fonts' :value='v') {{v}}
		<!--Font size-->
			select(v-model='fontsize' @change="formatDoc('fontsize', fontsize)")
				option(selected) Розмір шрифта
				option(v-for='v,k in fontsizes' :value='k') {{v}}
		<!--Font color-->
			select(v-model='forecolor' @change="formatDoc('forecolor', forecolor)")
				option(selected) Колір тексту
				option(v-for='v,k in forecolors' :value='k') {{v}}
		<!--Background color-->
			select(v-model='backcolor' @change="formatDoc('backcolor', backcolor)")
				option(selected) Фон тексту
				option(v-for='v,k in backcolors' :value='k') {{v}}
			i.fas.fa-undo(@click="formatDoc('undo')")
			i.fas.fa-redo(@click="formatDoc('redo')")
			i.fas.fa-eraser(@click="formatDoc('removeFormat')")
			i.fas.fa-bold(@click="formatDoc('bold')")
			i.fas.fa-italic(@click="formatDoc('italic')")
			i.fas.fa-underline(@click="formatDoc('underline')")
			i.fas.fa-align-left(@click="formatDoc('justifyleft')")
			i.fas.fa-align-center(@click="formatDoc('justifycenter')")
			i.fas.fa-align-right(@click="formatDoc('justifyright')")

		.screen(contenteditable='true')
			p(v-html='value')
</template>

<script>
	export default {
		name: 'text-editor',
		props: ['value'],
		data() {
			return {
				test: '',
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
				font: '',
				fonts: [
					'Arial',
					'Arial Black',
					'Courier New',
					'Times New Roman',
				],
				fontsize: '',
				fontsizes: {
					1: 'Very small',
					2: 'A bit small',
					3: 'Normal',
					4: 'Medium-large',
					5: 'Big',
					6: 'Very big',
					7: 'Maximum',
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
				console.log(cmd);
				console.log(val);
				let a = document.execCommand(cmd, false, val);
				console.log(a);
			}
		},
		mounted() {
			this.text = this.value;
		}
	}
</script>

<style lang="scss" scoped>
	.text-editor {
		width: 100vw;
		height: 100vh;
		position: fixed;

		.panel {
			height: 30px;
			background: #ece7e7;
			box-shadow: 0 0 7px 0;
		}

		.screen {
			display: block;
			background: white;
			height: 100vh;
			width: 100vw;
			padding: 20px;
		}
	}
</style>