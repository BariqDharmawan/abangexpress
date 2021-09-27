import 'boxicons';
import './main.js';
import { getFaq, getContact, getOurTeam } from './function/get-ajax';

getFaq('/api/faq')
getContact('/api/our-contact')
getOurTeam('/api/our-team')