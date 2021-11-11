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

function getContact(urlApi) {

    axios.get(urlApi).then((response) => {

        datas = response.data;

        //put our contact to each id element on landing page section contact
        const ourContacts = {
            "#location": {
                "link": datas.link_address,
                "value": datas.address,
            },
            "#email": {
                "link": `mailto:${datas.email}`,
                "value": datas.email
            },
            "#phone": {
                "link": `tel:62${datas.telephone}`,
                "value": `+62${datas.telephone}`
            }
        }

        if (datas.hasOwnProperty('key')) {
            for (const contact in ourContacts) {
                const subtextContactValue = document.querySelector(
                    `${contact} .list-group-simple__subtext a`
                )
                const plainContactValue = document.querySelector(`${contact} .contact-value`)

                if (subtextContactValue) {
                    subtextContactValue.href = ourContacts[contact].link
                    subtextContactValue.textContent = ourContacts[contact].value
                }
                else if (plainContactValue) {

                    plainContactValue.href = ourContacts[contact].link

                    plainContactValue.textContent = ourContacts[contact].value
                }
            }

            //put contact to navbar template 1
            const navEmail = document.querySelector('#nav-email .contact-value')
            const navPhone = document.querySelector('#nav-telephone .contact-value')
            navEmail.textContent = datas.email
            navEmail.href = `mailto:${datas.email}`

            navPhone.textContent = `+62${datas.telephone}`
            navPhone.href = `tel:${datas.telephone}`

            //end of that
        }
        else {
            document.querySelector('#navbar a[href="/#contact"]').parentElement.remove()
            document.querySelector('section#contact').remove()
        }
        //end of that

    })
    .catch(error => console.error(error))
}

export {getContact}
