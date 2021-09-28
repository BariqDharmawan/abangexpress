import 'boxicons';
import './main.js';
import { getFaq, getContact, getOurTeam, getContents } from './function/get-ajax';

getFaq('/api/faq')
getContact('/api/our-contact')
getOurTeam('/api/our-team')

document.querySelectorAll('.parent-load-data').forEach(parentData => {
    const elChild = parentData.querySelectorAll('.el-to-load-ajax')

    elChild.forEach(child => {
        const elType = child.dataset.contentType
        // console.log(elType)
        getContents(`/api/${parentData.dataset.apiSuffix}`, `#${parentData.id}`, elType)
    })

})