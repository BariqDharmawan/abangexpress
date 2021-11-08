import { previewImgUpload, removePath } from "./helper";

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


                    $("[name='recipient_country']").val(recipients.country).trigger('change')
                    $("[name='recipient_address']").val(recipients.address)

                    $("[name='recipient_idcard']").next().find('span').text(
                        removePath(recipients.idcard_photo)
                    )

                    previewImgUpload("#idcard-preview", recipients.idcard_photo)


                },
                error: function(error) {
                    $("#data-recipient .form-line").removeClass('focused')
                    alert('ada yang salah dengan API nya')
                    console.error(error)
                }
            })
        }
        else {
            $("[name='recipient_name']").val(null)
            $("[name='recipient_telephone']").val(null)
            $("[name='recipient_nik']").val(null)
            $("[name='recipient_zipcode']").val(null)
            $("[name='recipient_country']").val(null).trigger('change')
            $("[name='recipient_address']").val(null)
            $("[name='recipient_idcard']").next().find('span')
            .text('Gambar hanya boleh berekstensi .jpg, .jpeg, .png, .svg')
            $("[name='recipient_country']").val(null)

            $("#idcard-preview").addClass('d-none')
        }
    });

});
