import { previewImgUpload, removePath } from "./utilities";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $("#get-previous-recipient").change(function() {
        const recipientId = $(this).val()
        if (recipientId != 'penerima-baru') {

            $("#data-recipient .form-line").addClass('focused')

            $.ajax({
                type: "GET",
                url: `/shipping/order/get-recipient/${recipientId}`,
                success: function(recipients) {
                    
                    console.log(recipients)

                    if (recipients.country.includes('TAIWAN', 'KOREA SOUTH', 'INDIA')) {
                        $("[name='recipient_nik']").prop('required', true)
                    }
                    else {
                        $("[name='recipient_nik']").prop('required', false)
                    }

                    $("[name='recipient_name']").val(recipients.name)
                    $("[name='recipient_telephone']").val(recipients.telephone)
                    $("[name='recipient_nik']").val(recipients.idcard_number)
                    $("[name='recipient_zipcode']").val(recipients.zipcode)


                    $("[name='recipient_country']").val(recipients.country)
                    $("[name='recipient_address']").val(recipients.address)

                    $("[name='recipient_idcard']").next().find('span').text(
                        removePath(recipients.idcard_photo)
                    )

                    $("[name='recipient_country']").val(recipients.country)
                    $("[name='recipient_country']").trigger('change')

                    previewImgUpload("#idcard-preview", recipients.idcard_photo)

                    
                },
                error: function(error) {
                    $("#data-recipient .form-line").removeClass('focused')
                    alert('ada yang salah dengan API nya')
                    console.error(error)
                }
            })
        }
    });

});

function getCommercialInvoice() {
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
    }))

    return commercialInvoice
}

export {getCommercialInvoice}