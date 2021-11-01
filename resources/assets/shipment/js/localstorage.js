import { csrfToken, isAlreadyFillFormBook, isOnFormBookInvoicePage, regenerateDatatableAjax } from "./helper"
import { appendModal } from "./modal"

$(document).ready(function() {

    //redirect to invoice page if already fill book order
    if (isOnFormBookInvoicePage && !isAlreadyFillFormBook) {
        window.location.href = '/shipping/order/book'
    }

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
        regenerateDatatableAjax('#commercialInvoice', getCommercialInvoice(), [
            { "data": "no" },
            { "data": "desc" },
            { "data": "quantity_pcs" },
            { "data": "value_unit" },
            { "data": "total_value" },
            { "data": "action" }
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

    fillCommercialInvoice()

    //cancel submit form book and save data to localstorage
    $("#form-book-order").submit(function(e) {
        e.preventDefault()
        let bookOrder = new FormData($(this)[0])

        bookOrder.delete('_token')
        bookOrder.delete('recipient_idcard')

        for (const [key, value] of bookOrder) {
            localStorage.setItem(key, value)
        }

        $(this)[0].submit()
    })

    //submit form invoice and form booking order that saved on localstorage as well
    $("#form-invoice-order").submit(function(e) {
        e.preventDefault()
        const thisForm = $(this)[0]

        const getBookOrderOnPrevRequest = new FormData()
        const formDataInvoice = new FormData(thisForm)

        for (let key = 0; key < localStorage.length; key++) {
            const inputNameBookingOrder = localStorage.key(key)

            //form data booking order
            getBookOrderOnPrevRequest.append(
                inputNameBookingOrder,
                localStorage.getItem(inputNameBookingOrder)
            )
        }

        for (const invoice of formDataInvoice) {
            const inputNameInvoice = invoice[0]
            const inputValueInvoice = invoice[1]

            getBookOrderOnPrevRequest.append(inputNameInvoice, inputValueInvoice)
        }
        // create json format to store commercialInvoice data on localStorage
        var ciform = new FormData(thisForm),
            ciresult = {};

        ciform.delete('_token')

        for (const entry of ciform.entries()) {
            ciresult[entry[0]] = entry[1]
        }
        ciresult = JSON.stringify(ciresult)

        // check if there commercialInvoice on localStorage
        var oldCi = localStorage.getItem("commercialInvoice")
        if (oldCi === null) {
            localStorage.setItem('commercialInvoice', ciresult)
        } else {
            localStorage.setItem('commercialInvoice', oldCi + ',' + ciresult)
        }


        // Todo: submit ajax here
        $.ajax({
            url: "/shipping/order/book/invoice",
            data: getBookOrderOnPrevRequest,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {

                thisForm.reset()
                $("#form-invoice-order .form-line").removeClass('focused')
                $(".select2").val('').trigger('change')

                showInvoiceResult()

            },
            error: function(error) {
                console.log(error)
            }
        })

    })

    //submit form invoice and form booking order that saved on localstorage as well
    $("#print-invoice").submit(function(e) {
        e.preventDefault()

        let formBookOrder = new FormData($(this)[0])
        formBookOrder.delete('_token')

        const getBookOrderOnPrevRequest = new FormData()

        for (let key = 0; key < localStorage.length; key++) {
            const inputNameBookingOrder = localStorage.key(key)

            //form data booking order
            getBookOrderOnPrevRequest.append(
                inputNameBookingOrder,
                localStorage.getItem(inputNameBookingOrder)
            )
        }

        // Todo: submit ajax here
        $.ajax({
            url: "/shipping/order/book/invoice/save",
            data: getBookOrderOnPrevRequest,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {
                localStorage.clear()

                window.open('/shipping/order/print?key=' + response.data.token_resi, '_blank');
                window.open('/shipping', '_self');



            },
            error: function(error) {
                alert(error)
            }
        })

    })
    
    // delete commercial invoice content
    $(".btn-delete-value-attr").click(function() {
        $(this).parents('.modal').modal('hide')

        try {
            const ids = $(this).attr('value')

            let getCommercialInvoice = localStorage.getItem("commercialInvoice")
            getCommercialInvoice = getCommercialInvoice.split("},")

            if (getCommercialInvoice.length > 1) {
                let str1 = "";
                let ct = 1;
                for (let i = 0; i < getCommercialInvoice.length; i++) {
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

                window.location.reload()
            }
            else {
                localStorage.removeItem('commercialInvoice')
            }
        } catch (error) {
            console.error(error)
        }
    });


})