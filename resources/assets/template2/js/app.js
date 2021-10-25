import 'boxicons'
import './../../general/js/utilities'
import './main.js'
import { getFaq, getContact } from './../../general/js/get-ajax'

getFaq('/api/faq')
getContact('/api/our-contact')