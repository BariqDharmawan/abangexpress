import 'boxicons'
import { getFaq, getContact } from './../../general/js/get-ajax'
import './main'
import './../../general/js/panel'
import './scroll-to'
import './../../general/js/utilities'

if (document.querySelector('#load-faq')) {
    getFaq('/api/faq')
}
getContact('/api/our-contact')
