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
            $.ajax({
                type: "GET",
                url: `/shipping/order/pullPenerima/${recipientId}`,
                success: function(recipients) {

                    console.log(recipients)

                    $("[name='recipient_name']").val(recipients.name)
                    $("[name='recipient_telephone']").val(recipients.telephone)
                    $("[name='recipient_nik']").val(recipients.idcard_number)
                    $("[name='recipient_zipcode']").val(recipients.zipcode)


                    $("[name='recipient_country']").val(recipients.country)
                        // $("[name='recipient_country']").prop('disabled', true)
                        // $("[name='recipient_country']").trigger('change')
                    $("[name='recipient_address']").val(recipients.address)

                    $("[name='recipient_idcard']").next().find('span').text(
                        removePath(recipients.idcard_photo)
                    )

                    previewImgUpload("#idcard-preview", recipients.idcard_photo)

                    $("#data-recipient .form-line :input").prop('readonly', true)
                    $("#data-recipient .form-line").addClass('focused')
                },
                error: function() {
                    alert('ada yang salah dengan API nya')
                }
            })
        }
    });
});
