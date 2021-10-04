import 'boxicons';
import './main.js';
import { getFaq, getContact, getOurTeam, getOurService } from './function/get-ajax';

getFaq('/api/faq')
getContact('/api/our-contact')
getOurTeam('/api/our-team')
getOurService('/api/our-service')