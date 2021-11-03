import {
    previewImgUpload
} from './helper'

if ($(".select2").length > 0) {
    $(".select2").select2({
        theme: 'classic',
        allowClear: true
    })
}

$(document).ready(function () {

    $(".custom-file__input").each(function () {
        const label = $(this).next().find('span')
        const labelText = label.text()

        $(this).change(function (e) {
            if ($(this).val() !== '') {
                label.text(e.target.files[0].name).addClass('no-after')
            } else {
                label.text(labelText).removeClass('no-after')
            }
        })
    })


    if ($(".form-line :input").val() !== '') {
        $(".form-line :input").parents(".form-line").addClass('focused')
    }

    $(".form-line :input").change(function () {
        if ($(this).val() !== '') {
            $(this).parents(".form-line").addClass('focused')
        }
    })

    if ($(".only-number-not-allow-decimal").length > 0) {
        $('form button[type="submit"]').click(function (e) {
            e.preventDefault()

            if ($(".only-number-not-allow-decimal")[0].validity.stepMismatch) {
                $(".only-number-not-allow-decimal")[0].setCustomValidity(
                    'Jangan inputkan angka decimal'
                )
            } else {
                $(".only-number-not-allow-decimal")[0].setCustomValidity(' ')
                $(this).parents("form").trigger('submit')

            }
            $(".only-number-not-allow-decimal")[0].reportValidity()

        })
    }

    $("[accept='image/*']").change(function () {
        const imgPreview = $(this).data('img-preview');
        const inputHidden = $(this).data('input-hidden')
        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                previewImgUpload(imgPreview, e.target.result)
                const str = e.target.result
                // const arku = str.split("base64,")
                $(`#${inputHidden}`).val(str)
                console.log(str)
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            $(imgPreview).attr('src', '').addClass('d-none')
        }
    })

    function validateInputOnDb(inputToValidate) {
        inputToValidate.change(function () {

            const thisInput = $(this)
            const form = thisInput.parents('form')
            const urlToValidate = $(this).data('url-api')

            let dataToValidate = $(this).data()

            if ($(this).data('additional-from-val')) {
                const additionalData = $(this).data('additional-from-val')
                delete dataToValidate['additionalFromVal']

                dataToValidate[additionalData] = $(this).val()
            }

            console.log(dataToValidate)

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: urlToValidate,
                contentType: 'application/json',
                data: JSON.stringify(dataToValidate),
            }).always(function (response) {
                console.log(response)
                if (response.status === 'success') {
                    $(`.error-ajax-${thisInput.attr('name')}`).text('').addClass('d-none').removeClass('d-block')
                    form.find('button[type="submit"]').prop('disabled', false)
                }
                else {
                    $(`.error-ajax-${thisInput.attr('name')}`).text('Kodepos tidak dapat ditemukan').removeClass('d-none')
                    form.find('button[type="submit"]').prop('disabled', true)
                }
            })

        })
    }


    $(".check-other-input-based-on-this-value").change(function () {
        const inputRelated = $(this).data('input-related')
        const valueToCheck = $(this).data('value-to-check')
        const isValue = $(this).val()

        if (isValue == valueToCheck) {
            validateInputOnDb($(inputRelated))
        }
    })


})
