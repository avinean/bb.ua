import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/veiw/pages/Main'
import Contacts from '@/veiw/pages/Contacts'
import About from '@/veiw/pages/About'
import Dillers from '@/veiw/pages/Dillers'
import Articles from '@/veiw/pages/Articles'
import ArticlesPage from '@/veiw/pages/ArticlesPage'
import Quality from '@/veiw/pages/Quality'
import Arrival from '@/veiw/pages/Arrival'
import Payment from '@/veiw/pages/Payment'
import Catalog from '@/veiw/pages/Catalog'
import Products from '@/veiw/pages/Products'
import ProductPage from '@/veiw/pages/ProductPage'
import Admin from '@/veiw/pages/Admin'

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
			path: '/quality',
			name: 'Quality',
			component: Quality
		},
		{
			path: '/payment',
			name: 'Payment',
			component: Payment
		},
		{
			path: '/arrival',
			name: 'Arrival',
			component: Arrival
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
		}
	]
})
