import { enableOtherBtn, showElAfterClick } from "./btn"

$(document).ready(function() {

    const isAlreadyFillFormBook = localStorage.getItem('sender_name') ? true : false
    const isOnFormBookInvoicePage = (window.location.pathname ==
        '/shipping/order/book/invoice') ? true : false

    if (isOnFormBookInvoicePage && !isAlreadyFillFormBook) {
        window.location.href = '/shipping/order/book'
    }

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
        const btnSubmit = $(this).find("button[type='submit']")

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
        console.log(ciresult);
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
                console.log('response', response.commercialInvoice)
                alert(response.message + ', please see console')
                thisForm.reset()

                $(".select2").val('').trigger('change')

                // refresh dataTable
                const data = JSON.parse(
                    '[' + localStorage.getItem("commercialInvoice") + ']'
                )
                const commercialInvoice = data.map((invoice, index) => ({
                        ...invoice, 
                        no: index + 1,
                        total_value: Number(invoice.quantity) * 
                                     Number(invoice.value_unit),
                        action: `<button class="btn waves-effect btn-danger" 
                        data-toggle="modal" type="button"
                        data-target="#delete-data-${index + 1}">
                            <i class="material-icons">delete</i>
                        </button>`
                    })
                )

                console.log('data', commercialInvoice)
                $('#commercialInvoice').DataTable().destroy()
                $('#commercialInvoice').DataTable({
                    "data": commercialInvoice,
                    "columns": [
                        { "data": "no" },
                        { "data": "desc" },
                        { "data": "unit" },
                        { "data": "quantity" },
                        { "data": "value_unit" },
                        { "data": "total_value" },
                        { "data": "action" }
                    ]
                })
                $('#commercialInvoice').DataTable().draw()

                if (btnSubmit.hasClass('enable-other-btn')) {
                    enableOtherBtn(btnSubmit)
                }
                if (btnSubmit.hasClass('show-el-after-click')) {
                    showElAfterClick(btnSubmit)
                }

                for (let i = 0; i < commercialInvoice.length; i++) {
                    const modalFade = $("<div>", {
                        id: `delete-data-${i + 1}`,
                        class: 'modal fade',
                        tabindex: '-1',
                        role: 'dialog'
                    })

                    const csrfToken = $("meta[name='csrf-token']").attr('content')
                    $(`<div class="modal fade" id="delete-data-${i + 1}" 
                        tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="{{ $id }}Label">
                                            Hapus data ${i + 1}
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Apakah kamu yakin, ingin menghapus data 
                                            ${i + 1}
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">
                                                Tidak jadi
                                            </button>
                                            <form action="" method="POST">
                                                <input type="hidden" name="_token"
                                                value="${csrfToken}">
                                                <input type="hidden" name="_method"
                                                value="DELETE">
                                                <button type="button" class="btn btn-danger waves-effect">
                                                    Ya, hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).appendTo('body')
                }

            },
            error: function(error) {
                alert(error)
            }
        })

    })

    //submit form invoice and form booking order that saved on localstorage as well
    $("#form-save-order").submit(function(e) {
        e.preventDefault()
        const thisForm = $(this)[0]
        let xbookOrder = new FormData($(this)[0])

        xbookOrder.delete('_token')

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
                    // console.log(response.data.link_resi)
                alert(response.message)

                window.open(response.data.link_resi, '_blank');
                window.open('/shipping', '_self');



            },
            error: function(error) {
                alert(error)
            }
        })

    })

})
