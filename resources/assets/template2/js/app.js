import 'boxicons';
import './main.js';
import { getFaq, getContact, getOurTeam } from './../../general/js/get-ajax';

getFaq('/api/faq')
getContact('/api/our-contact')
getOurTeam('/api/our-team')