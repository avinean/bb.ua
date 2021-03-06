import Vue from 'vue'
import App from './veiw/App'
import router from './router.js'
import store from './store.js'

import axios from 'axios'
import VueAxios from 'vue-axios'
const axiosInstance = axios.create({
	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
});
Vue.use(VueAxios, axiosInstance);

import VueAgile from 'vue-agile'
Vue.use(VueAgile);

import Mixins from './mixins'
Vue.mixin(Mixins);

import Components from './components'
Components.forEach(e => Vue.component(e.name, e.comp));

Vue.config.productionTip = false;

async function init() {

	let is = new Vue();

	Vue.prototype.pagesMeta = pagesMeta;
	Vue.prototype.meta = generalMeta;
	Vue.prototype.infoRelated = infoRelated;
	Vue.prototype.finders = finders;
	Vue.prototype.colorsMap = colorsMap;

	new Vue({
		el: '#app',
		router,
		store,
		render: e => e(App)
	});
}

init();


