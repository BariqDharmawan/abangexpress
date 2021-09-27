import 'boxicons';
import { getFaq, getContact } from '../../template2/js/function/get-ajax.js';
import './../vendor/php-email-form/validate.js';
import './main';

getFaq('/api/faq')
getContact('/api/our-contact')