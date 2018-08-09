import Vue from 'vue'
import App from './veiw/App'
import router from './router.js'
import store from './store.js'

import axios from 'axios'
import VueAxios from 'vue-axios'
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded'
Vue.use(VueAxios, axios)

import VueAgile from 'vue-agile'
Vue.use(VueAgile)

import Header from './veiw/parts/Header'
import Footer from './veiw/parts/Footer'
import Callback from './veiw/components/Callback'
import Slider from './veiw/components/Slider'
import Btn from './veiw/components/Btn'
import Popup from './veiw/components/Popup'

Vue.component('page-header', Header)
Vue.component('page-footer', Footer)
Vue.component('callback', Callback)
Vue.component('slider', Slider)
Vue.component('btn', Btn)
Vue.component('popup', Popup)


Vue.config.productionTip = false


new Vue({
	el: '#app',
	router,
	store,
	render: e => e(App)
})
