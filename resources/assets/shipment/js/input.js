import {
    previewImgUpload
} from './helper'

if ($(".select2").length > 0) {
    $(".select2").select2({
        theme: 'classic',
        allowClear: true
    })
}

function showInputBaseOnOtherInput(condition, inputs) {
    let allInput = inputs.split(',')
    for (let i = 0; i < allInput.length; i++) {
        if (condition) {
            $(allInput[i]).prop('required', false).removeClass('d-none').addClass('d-block')
            $(allInput[i]).closest("[class*='col-']").removeClass('d-none').addClass('d-block')
            $(allInput[i]).closest("[class*='col-']").parent("[class*='col-']").addClass('d-block').removeClass('d-none')
        } else {
            $(allInput[i]).addClass('d-none').removeClass('d-block')
            $(allInput[i]).closest("[class*='col-']").addClass('d-none').removeClass('d-block')
            $(allInput[i]).closest("[class*='col-']").parent("[class*='col-']").addClass('d-none').removeClass('d-block')
        }
    }
}

$(document).ready(function() {

    $("input.d-none").closest("[class*='col-']").parent("[class*='col-']").addClass('d-none')
    $("select.d-none").closest("[class*='col-']").addClass('d-none')


    $(".custom-file__input").each(function() {
        const label = $(this).next().find('span')
        const labelText = label.text()

        $(this).change(function(e) {
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

    $(".form-line :input").change(function() {
        if ($(this).val() !== '') {
            $(this).parents(".form-line").addClass('focused')
        }
    })

    if ($(".only-number-not-allow-decimal").length > 0) {
        $('form button[type="submit"]').click(function(e) {
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

    $("[accept='image/*']").change(function() {
        const imgPreview = $(this).data('img-preview');
        const inputHidden = $(this).data('input-hidden')
        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                previewImgUpload(imgPreview, e.target.result)
                const str = e.target.result
                    // const arku = str.split("base64,")
                $(`#${inputHidden}`).val(str)
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            $(imgPreview).attr('src', '').addClass('d-none')
        }
    })

    function validateInputOnDb(inputToValidate) {
        inputToValidate.change(function() {
            const thisInput = $(this)

            if (thisInput.val() != '') {
                const form = thisInput.parents('form')
                const urlToValidate = $(this).data('url-api')

                let dataToValidate = $(this).data()

                if ($(this).data('additional-from-val')) {
                    const additionalData = $(this).data('additional-from-val')
                    delete dataToValidate['additionalFromVal']
                    delete dataToValidate['responseFieldToShow']
                    delete dataToValidate['responseApiWish']
                    delete dataToValidate['inputToShow']
                    delete dataToValidate['putMin']
                    delete dataToValidate['putMax']

                    dataToValidate[additionalData] = $(this).val()
                }

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: urlToValidate,
                    contentType: 'application/json',
                    data: JSON.stringify(dataToValidate),
                }).always(function(response) {
                    if (response.status === 'success') {
                        $(`.error-ajax-${thisInput.attr('name')}`).text('').addClass('d-none').removeClass('d-block')
                        form.find('button[type="submit"]').prop('disabled', false)
                    } else {
                        $(`.error-ajax-${thisInput.attr('name')}`).text('Kodepos tidak dapat ditemukan')
                            .removeClass('d-none')
                        form.find('button[type="submit"]').prop('disabled', true)
                    }
                })
            } else {
                $(`.error-ajax-${thisInput.attr('name')}`).text('').addClass('d-none')
            }

        })
    }

    $(".validate-if-response-api-is-something").change(function() {
        const thisInput = $(this)

        const responseApiWish = $(this).data('response-api-wish')
        const urlToValidate = $(this).data('url-api')
        const fieldToShow = $(this).data('response-field-to-show')

        let dataToValidate = $(this).data()
        if ($(this).data('additional-from-val')) {
            const additionalData = $(this).data('additional-from-val')

            delete dataToValidate['additionalFromVal']
            delete dataToValidate['urlApi']
            delete dataToValidate['responseFieldToShow']
            delete dataToValidate['responseApiWish']
            delete dataToValidate['inputToShow']
            delete dataToValidate['inputToPutMinMax']
            delete dataToValidate['putMin']
            delete dataToValidate['putMax']

            dataToValidate[additionalData] = $(this).val()
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: urlToValidate,
            contentType: 'application/json',
            data: JSON.stringify(dataToValidate),
        }).always(function(data) {

            let inputToShow = thisInput.data('input-to-show')

            console.log(`status : ${data.status}`)

            if (data.status == 'success') {
                const arrayResponse = data.response[0][fieldToShow]
                    // console.log(arrayResponse)

                if (thisInput.hasClass('add-option-to-other-select-based-on-this-input')) {
                    $("#courier").empty()
                    arrayResponse.forEach(option => {
                        $("#courier").append(new Option(option, option)).trigger('change')
                    });
                }


                if (thisInput.hasClass('show-other-input') && arrayResponse.includes(responseApiWish)) {
                    showInputBaseOnOtherInput(true, inputToShow, thisInput)

                    // if (thisInput.hasClass('put-min-max-to-other-input')) {
                    //     const min = thisInput.data('put-min')
                    //     const max = thisInput.data('put-max')
                    //     putMinMaxValidation(true, $(thisInput.data('input-to-put-min-max')), min, max)
                    // }
                }
            } else {
                if (thisInput.hasClass('show-other-input')) {
                    showInputBaseOnOtherInput(false, inputToShow, thisInput)
                }
                if (thisInput.hasClass('put-min-max-to-other-input')) {
                    // putMinMaxValidation(false, $(thisInput.data('input-to-put-min-max')))
                }
            }

        })

    })


    $(".check-other-input-based-on-this-value").change(function() {
        const inputRelated = $(this).data('input-related')
        const valueToCheck = $(this).data('value-to-check')
        const isValue = $(this).val()


        if (isValue == 'TAIWAN') {
            document.getElementById("recipient-zipcode").setAttribute("data-input-to-put-min-max", "#package-weight")
            document.getElementById("recipient-zipcode").setAttribute("data-put-min", "4")
            document.getElementById("recipient-zipcode").setAttribute("data-put-max", "23")
            document.getElementById("recipient-zipcode").setAttribute("data-input-to-show", "#package-length,#package-width,#package-height,#courier")
            document.getElementById("recipient-zipcode").setAttribute("data-url-api", "/shipping/check-zipcode")
            document.getElementById("recipient-zipcode").setAttribute("data-akun", "coloader")
            document.getElementById("recipient-zipcode").setAttribute("data-response-field-to-show", "courier")
            document.getElementById("recipient-zipcode").setAttribute("data-key", "f03e563b71454776e2cb1e7b5f5ea5c4")
            document.getElementById("recipient-zipcode").setAttribute("data-country", "" + isValue + "")
            document.getElementById("recipient-zipcode").setAttribute("data-additional-from-val", "zipcode")
            document.getElementById("recipient-zipcode").setAttribute("data-response-api-wish", "heimao")
            document.getElementById("recipient-zipcode").setAttribute("minlength", "3")
            document.getElementById("recipient-zipcode").setAttribute("maxlength", "8")
        }
        validateInputOnDb($(inputRelated))
    })

    // function xCountry(str) {
    //     const inputRelated = $(this).data('input-related')
    //     const valueToCheck = $(this).data('value-to-check')
    //     const isValue = $(this).val()

    //     if (isValue == 'TAIWAN') {
    //         validateInputOnDb($(inputRelated))
    //     }
    // }

    $(".disable-one-option-if-this-value-something").change(function() {
        const dropdownTarget = $(this).data('dropdown-target')
        const optionToDisable = $(this).data('option-to-disable')
        var packHeight = document.getElementById('package-height').value
        var packWidth = document.getElementById('package-width').value
        var packLength = document.getElementById('package-length').value
        let dim = parseInt(packHeight) + parseInt(packLength) + parseInt(packWidth)

        if (packHeight == '' || packWidth == '' || packLength == '') {
            console.log('please fill all data')
        } else {
            // console.log(dim)
            if ($(this).val() < 4 || $(this).val() > 23 || dim > 150) {
                $(`${dropdownTarget} option[value="${optionToDisable}"]`).prop('disabled', true)
            } else {
                $(`${dropdownTarget} option[value="${optionToDisable}"]`).prop('disabled', false)
            }
        }
        $(dropdownTarget).trigger('change')


    })

    $(".disable-one-option-if-this-value-something").focusout(function() {
        const dropdownTarget = $(this).data('dropdown-target')
        const optionToDisable = $(this).data('option-to-disable')
        var packHeight = document.getElementById('package-height').value
        var packWidth = document.getElementById('package-width').value
        var packLength = document.getElementById('package-length').value
        var dim = parseInt(packHeight) + parseInt(packLength) + parseInt(packWidth)

        if (packHeight == '' || packWidth == '' || packLength == '') {
            console.log('please fill all data')
        } else {
            console.log(dim)
            if ($(this).val() < 4 || $(this).val() > 23 || dim > 150) {
                $(`${dropdownTarget} option[value="${optionToDisable}"]`).prop('disabled', true)
            } else {
                $(`${dropdownTarget} option[value="${optionToDisable}"]`).prop('disabled', false)
            }
        }
        $(dropdownTarget).trigger('change')

    })



})