import axios from "axios"

let datas = null
let elRecord = null
let parentData = null

async function getAjax(urlApi, parentEl) {
    let response = null, datas = null
    try {
        response = await axios.get(urlApi)
        datas = response.data

        const parentData = document.querySelector(parentEl).cloneNode(true)
        
        return {parentData, datas}

    } catch (error) {
        console.error(error)
    }

}

function getFaq(urlApi) {
    let accordionToggler = null

    getAjax(urlApi, '#load-faq').then(result => {
        for (const record of result.datas) {

            // console.log(record)

            const idFaq = record.question.toLowerCase().replaceAll(' ', '-')

            elRecord = result.parentData.querySelector('.accordion-faq').cloneNode(true)
            elRecord.querySelector('.accordion__heading').textContent = record.question
            elRecord.querySelector('.accordion__text p').textContent = record.answer
            
            accordionToggler = elRecord.querySelector('.toggler-accordion')
            accordionToggler.setAttribute(
                'data-bs-target', `#accordion-list-${idFaq}`
            )

            elRecord.querySelector('.accordion__text').id = `accordion-list-${idFaq}`
            
            document.querySelector(`#${result.parentData.id}`).appendChild(elRecord)
        }

        //remove `initial` element
        document.querySelector('.accordion-faq').remove()
    })
}

function getContact(urlApi) {

    axios.get(urlApi).then((response) => {

        let accordionToggler = null
        datas = response.data;

        //put email to #cta-email button
        const ctaEmail = document.querySelector('#cta-email')
        if (ctaEmail) {
            ctaEmail.href = `mailto:${datas.email}`
            ctaEmail.textContent = datas.email
        }

        //put our contact to each id element on landing page section contact
        const ourContacts = {
            "#location": {
                "link": datas.link_address,
                "value": datas.address
            },
            "#email": {
                "link": `mailto:${datas.email}`,
                "value": datas.email
            },
            "#phone": {
                "link": `tel:${datas.telephone}`,
                "value": datas.telephone
            }
        }

        for (const contact in ourContacts) {
            const subtextContactValue = document.querySelector(
                `${contact} .list-group-simple__subtext`
            )
            const plainContactValue = document.querySelector(`${contact} .contact-value`)
            
            if (subtextContactValue) {
                subtextContactValue.textContent = ourContacts[contact].value
            }
            else if (plainContactValue) {

                plainContactValue.href = ourContacts[contact].link

                plainContactValue.textContent = ourContacts[contact].value
            }
        }
        //end of that

        //put contact to navbar template 1
        const navEmail = document.querySelector('#nav-email .contact-value')
        const navPhone = document.querySelector('#nav-telephone .contact-value')

        if (navEmail && navPhone) {
            navEmail.textContent = datas.email
            navEmail.href = `mailto:${datas.email}`

            navPhone.textContent = datas.telephone
            navPhone.href = `mailto:${datas.telephone}`
        }
        //end of that
        

    })
    .catch(error => console.error(error))
}

function getOurTeam(urlApi) {

    let memberInfo = {}
    axios.get(urlApi).then((response) => {
        parentData = document.querySelector('#load-member')
        datas = response.data
        
        for (const person of datas) {

            memberInfo = {
                "avatar": person.avatar,
                "name": person.name,
                "position": person.position.name,
                "desc": person.short_desc
            }

            elRecord = parentData.querySelector('.member-item').cloneNode(true)
            for (const member in memberInfo) {
                
                const isNotImg = !elRecord.querySelector(`.member-info__${member}`)
                                        .hasAttribute('src')
                if (isNotImg) {
                    elRecord.querySelector(`.member-info__${member}`)
                            .textContent = memberInfo[member]
                }
                else {
                    elRecord.querySelector(`.member-info__${member}`).src = memberInfo[member]
                }

            }
            parentData.appendChild(elRecord)
        }

        document.querySelector('.member-item').remove()


    }).catch(error => console.error(error))
}

function getOurService(urlApi, parentEl) {
    let ourService = {}
    getAjax(urlApi, '#load-our-service').then(result => {
        
        console.log(`datas: `, result.datas)
        
        for (const [i, record] of result.datas.entries()) {
            elRecord = result.parentData.querySelector('.el-to-load-ajax').cloneNode(true)

            ourService = {
                'icon': record.icon, 
                'name': record.title, 
                'short-desc': record.desc
            }

            // console.log(Object.values(ourService))
            // console.log(Object.keys(ourService))

            for (let i = 0; i < Object.keys(ourService).length; i++) {
                const isNotImg = !elRecord.querySelector(
                    `.card__${Object.keys(ourService)[i]}`
                ).hasAttribute('src')
                const hasHref = elRecord.querySelector(
                    `.card__${Object.keys(ourService)[i]}`
                ).hasAttribute('href')

                if (isNotImg) {
                    elRecord.querySelector(`.card__${Object.keys(ourService)[i]}`)
                            .textContent = Object.values(ourService)[i]
                }
                else {
                    elRecord.querySelector(`.card__${Object.keys(ourService)[i]}`)
                            .src = Object.values(ourService)[i]
                }
                
            }
            elRecord.setAttribute('data-aos-delay', Number((i + 1) * 100))
            // console.log(result.parentData)
            document.querySelector(`#${result.parentData.id}`).appendChild(elRecord)
        }
        
        document.querySelector(`#${result.parentData.id}`)
                .querySelector('.el-to-load-ajax').remove()
    })
}

export {getFaq, getContact, getOurTeam, getOurService}