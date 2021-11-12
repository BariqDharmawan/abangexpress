import {
    csrfToken,
    regenerateDatatableAjax
} from "./helper";
import {
    appendModal
} from "./modal";

function getCommercialInvoice() {
    const commercialInvoice = JSON.parse(
        '[' + localStorage.getItem("commercialInvoice") + ']'
    )

    return commercialInvoice.map((invoice, index) => ({
        ...invoice,
        no: index + 1,
        quantity_pcs: `${invoice.quantity} ${invoice.unit}`,
        value_unit: new Intl.NumberFormat('en-US').format(invoice.value_unit),
        total_value: new Intl.NumberFormat('en-US').format(
            Number(invoice.quantity) * Number(invoice.value_unit)
        ),
        action: `<button class="btn waves-effect btn-danger"
            data-toggle="modal" type="button"
            data-target="#delete-data-${index + 1}">
                <i class="material-icons">delete</i>
            </button>`
    }))
}

function showInvoiceResult() {
    // refresh dataTable
    regenerateDatatableAjax('#commercialInvoice', getCommercialInvoice(), [{
            "data": "no"
        },
        {
            "data": "desc"
        },
        {
            "data": "quantity_pcs"
        },
        {
            "data": "value_unit"
        },
        {
            "data": "total_value"
        },
        {
            "data": "action"
        }
    ])

    $("#btn-generate-pdf").removeAttr("disabled");

    for (let i = 0; i < getCommercialInvoice().length; i++) {
        appendModal(`delete-data-${i + 1}`, `Hapus data ${i + 1}`,
            `<p>
            Apakah kamu yakin, ingin menghapus data ${i + 1}
        </p>`,
            `<div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">
                    Tidak jadi
                </button>
                <input type="hidden" name="_token"
                    value="${csrfToken}">
                <input type="hidden" name="_method"
                    value="DELETE">
                <button type="button" value="${i + 1}" class="btn btn-danger waves-effect btn-delete-value-attr">
                    Ya, hapus
                </button>
        </div>`)
    }
}

function fillCommercialInvoice() {
    // generate commercial invoice table data
    var oldCi = localStorage.getItem("commercialInvoice")
    if (oldCi === null) {
        // no data dont generate
        $("#btn-generate-pdf").attr("disabled");
    } else {
        // generate data
        showInvoiceResult()
    }

}

function removeCommercialInvoice(btn) {
    try {
        const ids = btn.attr('value')

        let getCommercialInvoice = localStorage.getItem("commercialInvoice")
        getCommercialInvoice = getCommercialInvoice.split("},")

        if (getCommercialInvoice.length > 1) {
            console.log('commercial invoice more than 1')
            let str1 = "";
            let ct = 1;
            for (let i = 0; i < getCommercialInvoice.length; i++) {
                console.log(getCommercialInvoice[i])
                if (i != ids - 1) {
                    let xstr2 = "";
                    xstr2 = getCommercialInvoice[i].replace("{", "")
                    xstr2 = xstr2.replace("}", "")
                    if (ct == 1) {
                        str1 = str1.concat('{' + xstr2 + '}')
                    } else {
                        str1 = str1.concat(',{' + xstr2 + '}')
                    }
                    ct++
                }
            }
            localStorage.setItem('commercialInvoice', str1)
            fillCommercialInvoice()


        } else {
            console.log('commercial invoice not more than 1')
            localStorage.removeItem('commercialInvoice')
        }

        window.location.reload()

    } catch (error) {
        console.error(error)
    }
}

function getLocalstorageBookOrder(needReturn = false) {
    const getBookOrder = new FormData()

    for (let key = 0; key < localStorage.length; key++) {
        const inputNameBookingOrder = localStorage.key(key)

        //form data booking order
        getBookOrder.append(
            inputNameBookingOrder,
            localStorage.getItem(inputNameBookingOrder)
        )
    }

    if (needReturn) {
        return getBookOrder
    }
}

function getBookOrderOnPrevRequest(form) {
    let formBookOrder = new FormData(form)
    formBookOrder.delete('_token')

    const getBookOrderOnPrevRequest = new FormData()

    getLocalstorageBookOrder()

    return getBookOrderOnPrevRequest
}

function appendInvoiceToBookOrder(bookOrder, form) {
    for (const invoice of form) {
        const inputNameInvoice = invoice[0]
        const inputValueInvoice = invoice[1]

        bookOrder.append(inputNameInvoice, inputValueInvoice)
    }
}

function storeBookOrderToLocal(form) {
    let bookOrder = new FormData(form)

    bookOrder.delete('_token')
    bookOrder.delete('recipient_idcard')

    for (const [key, value] of bookOrder) {
        localStorage.setItem(key, value)
    }


    form.submit()
}

function storeCommercialInvoiceToLocal(form) {
    let ciform = new FormData(form),
        commercialInvoice = {};

    ciform.delete('_token')

    for (const entry of ciform.entries()) {
        commercialInvoice[entry[0]] = entry[1]
    }

    commercialInvoice = JSON.stringify(commercialInvoice)

    return commercialInvoice;
}

export {
    fillCommercialInvoice,
    getCommercialInvoice,
    showInvoiceResult,
    removeCommercialInvoice,
    getBookOrderOnPrevRequest,
    getLocalstorageBookOrder,
    appendInvoiceToBookOrder,
    storeBookOrderToLocal,
    storeCommercialInvoiceToLocal
}
