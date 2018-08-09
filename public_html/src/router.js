import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/veiw/pages/Main'
import Contacts from '@/veiw/pages/Contacts'
import About from '@/veiw/pages/About'
import Dillers from '@/veiw/pages/Dillers'
import News from '@/veiw/pages/News'
import Info from '@/veiw/pages/Info'

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
			path: '/about',
			name: 'About',
			component: About
		},
		{
			path: '/dillers',
			name: 'Dillers',
			component: Dillers
		},
		{
			path: '/news',
			name: 'News',
			component: News
		},
		{
			path: '/info',
			name: 'Info',
			component: Info
		}
	]
})
