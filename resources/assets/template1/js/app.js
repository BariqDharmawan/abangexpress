import 'boxicons';
import { getFaq, getContact } from './../../general/js/get-ajax';
import './../vendor/php-email-form/validate.js';
import './main'
import './panel'
import './scroll-to'
import './input';

getFaq('/api/faq')
getContact('/api/our-contact')