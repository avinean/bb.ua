import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/veiw/pages/Main'
import Contacts from '@/veiw/pages/Contacts'
import About from '@/veiw/pages/About'
import Dillers from '@/veiw/pages/Dillers'
import News from '@/veiw/pages/News'
import Info from '@/veiw/pages/Info'
import Quality from '@/veiw/pages/Quality'
import Catalog from '@/veiw/pages/Catalog'
import Categories from '@/veiw/pages/Categories'
import Description from '@/veiw/pages/Description'

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
		},
		{
			path: '/quality',
			name: 'Quality',
			component: Quality
		},
		{
			path: '/catalog',
			name: 'Catalog',
			component: Catalog
		},
		{
			path: '/catalog/:category',
			name: 'Categories',
			component: Categories
		},
		{
			path: '/catalog/:category/:id',
			name: 'Description',
			component: Description
		}
	]
})
