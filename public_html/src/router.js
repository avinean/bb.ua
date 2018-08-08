import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/veiw/pages/Main'
import Contacts from '@/veiw/pages/Contacts'
import Quality from '@/veiw/pages/Quality'
import Price from '@/veiw/pages/Price'
import Gallery from '@/veiw/pages/Gallery'

Vue.use(Router)

export default new Router({
	mode: 'history',
	routes: [
		{
			path: '/',
			name: 'Main',
			component: Main
		},
		{
			path: '/contacts',
			name: 'Contacts',
			component: Contacts
		},
		{
			path: '/gallery',
			name: 'Gallery',
			component: Gallery
		},
		{
			path: '/quality',
			name: 'Quality',
			component: Quality
		},
		{
			path: '/price',
			name: 'Price',
			component: Price
		}
	]
})
