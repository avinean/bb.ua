import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/veiw/pages/Main'
import Contacts from '@/veiw/pages/Contacts'
import InfoPage from '@/veiw/pages/InfoPage'
import Articles from '@/veiw/pages/Articles'
import ArticlesPage from '@/veiw/pages/ArticlesPage'
import Catalog from '@/veiw/pages/Catalog'
import Products from '@/veiw/pages/Products'
import ProductPage from '@/veiw/pages/ProductPage'
import Admin from '@/veiw/pages/Admin'
import Search from '@/veiw/pages/Search'

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
			path: '/admin',
			name: 'Admin',
			component: Admin
		},
		{
			path: '/news',
			name: 'Articles-news',
			component: Articles
		},
		{
			path: '/news/:id',
			name: 'ArticlesPage-news',
			component: ArticlesPage
		},
		{
			path: '/info',
			name: 'Articles-info',
			component: Articles
		},
		{
			path: '/info/:id',
			name: 'ArticlesPage-info',
			component: ArticlesPage
		},
		{
			path: '/about',
			name: 'About',
			component: InfoPage
		},
		{
			path: '/quality',
			name: 'Quality',
			component: InfoPage
		},
		{
			path: '/payment',
			name: 'Payment',
			component: InfoPage
		},
		{
			path: '/arrival',
			name: 'Arrival',
			component: InfoPage
		},
		{
			path: '/dillers',
			name: 'Dillers',
			component: InfoPage
		},
		{
			path: '/sale',
			name: 'Articles-sale',
			component: Articles
		},
		{
			path: '/sale/:id',
			name: 'ArticlesPage-sale',
			component: ArticlesPage
		},
		{
			path: '/catalog',
			name: 'Catalog',
			component: Catalog
		},
		{
			path: '/catalog/:category',
			name: 'Products',
			component: Products
		},
		{
			path: '/catalog/:category/:id',
			name: 'ProductPage',
			component: ProductPage
		},
		{
			path: '/search',
			name: 'Search',
			component: Search
		}
	]
})
