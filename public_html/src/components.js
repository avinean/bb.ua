import Header from './veiw/parts/Header'
import Footer from './veiw/parts/Footer'
import Callback from './veiw/components/Callback'
import Slider from './veiw/components/Slider'
import Popup from './veiw/components/Popup'
import Up from './veiw/components/Up'
import ImgLoader from './veiw/components/ImgLoader'

export default [
	{name: 'page-header', comp: Header},
	{name: 'page-footer', comp: Footer},
	{name: 'callback', comp: Callback},
	{name: 'slider', comp: Slider},
	{name: 'popup', comp: Popup},
	{name: 'up', comp: Up},
	{name: 'img-loader', comp: ImgLoader},
]