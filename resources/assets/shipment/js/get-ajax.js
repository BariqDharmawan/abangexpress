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
                url: `/shipping/order/pullPenerima/${recipientId}`,
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
                error: function() {
                    $("#data-recipient .form-line").removeClass('focused')
                    alert('ada yang salah dengan API nya')
                }
            })
        }
    });
});
