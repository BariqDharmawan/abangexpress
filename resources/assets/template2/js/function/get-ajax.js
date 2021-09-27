import axios from "axios"

let datas = null
let elRecord = null
let parentData = null

function getFaq(urlApi) {
    axios.get(urlApi).then((response) => {
        parentData = document.querySelector('#load-faq')

        let accordionToggler = null
        datas = response.data;
        
        for (const record of datas) {
            const idFaq = record.question.toLowerCase().replaceAll(' ', '-')

            elRecord = parentData.querySelector('.accordion-faq').cloneNode(true)

            elRecord.querySelector('.accordion__heading').textContent = record.question
            elRecord.querySelector('.accordion__text p').textContent = record.answer
            
            accordionToggler = elRecord.querySelector('.toggler-accordion')
            accordionToggler.setAttribute(
                'data-bs-target', `#accordion-list-${idFaq}`
            )

            elRecord.querySelector('.accordion__text').id = `accordion-list-${idFaq}`
            
            parentData.appendChild(elRecord)
        }

        document.querySelector('.accordion-faq').remove()

        parentData.querySelectorAll('.accordion-faq:not(:first-child)').forEach(faq => {
            faq.querySelector('[id*="accordion-list-"]').classList.remove('show')
            
            faq.querySelector('.toggler-accordion').classList.remove('collapse')
            faq.querySelector('.toggler-accordion').classList.add('collapsed')
        })

    })
    .catch(error => console.error(error))
}

function getOurService(urlApi) {
    axios.get(urlApi).then(response => {
        datas = response.data
        console.info(response)
    })
}

function getContact(urlApi) {
    let contactEl = null

    axios.get(urlApi).then((response) => {

        let accordionToggler = null
        datas = response.data;

        const ctaEmail = document.querySelector('#cta-email')
        if (ctaEmail) {
            ctaEmail.textContent = datas.email
        }

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

    })
    .catch(error => console.error(error))
}

function getOurTeam(urlApi) {
    let memberInfo = {}
    axios.get(urlApi).then((response) => {
        parentData = document.querySelector('#load-member')
        datas = response.data

        console.info(datas)

        
        for (const person of datas) {

            memberInfo = {
                "avatar": person.avatar,
                "name": person.name,
                "position": person.position.name,
                "desc": person.short_desc
            }

            elRecord = parentData.querySelector('.member-item').cloneNode(true)
            for (const member in memberInfo) {
                console.info(`${member}: ${memberInfo[member]}`)
                
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

            console.info(' ')
            parentData.appendChild(elRecord)
        }

        document.querySelector('.member-item').remove()


    }).catch(error => console.error(error))
}

export {getFaq, getContact, getOurService, getOurTeam}