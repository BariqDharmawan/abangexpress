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

    $("input.d-none").closest("[class*='col-']").parent("[class*='col-']").addClass('d-none')
    $("select.d-none").closest("[class*='col-']").addClass('d-none')


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

    $("[accept='image/*']").change(function () {
        const imgPreview = $(this).data('img-preview');
        const inputHidden = $(this).data('input-hidden')
        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                previewImgUpload(imgPreview, e.target.result)
                const str = e.target.result
                $(`#${inputHidden}`).val(str)
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            $(imgPreview).attr('src', '').addClass('d-none')
        }
    })

    function validateZipcode(input, urlApi) {
        const form = $(input).parents('form')
        console.log(input)

        if ($(input).val() != '') {

            let dataToValidate = {
                akun: $(input).data('akun'),
                country: $(input).data('country'),
                key: $(input).data('key'),
                zipcode: $(input).val()
            }

            console.log(`dataToValidate`, dataToValidate)

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: urlApi,
                contentType: 'application/json',
                data: JSON.stringify(dataToValidate),
            }).always(function (response) {

                console.log(response)

                if (response.status === 'success') {
                    const listCourier = response.response[0].courier

                    $(`.error-ajax-${$(input).attr('name')}`).text('').addClass('d-none').removeClass('d-block')

                    listCourier.forEach(courier => {
                        console.log(`courier: ${courier}`)
                        $("#courier").append(new Option(courier, courier))
                    });

                    if (listCourier.includes('heimao')) {
                        $("#select-courier").removeClass('d-none')
                    }

                } else {
                    $(`.error-ajax-${$(input).attr('name')}`).text('Kodepos tidak dapat ditemukan')
                        .removeClass('d-none')
                }
            })
        } else {
            $(`.error-ajax-${$(input).attr('name')}`).text('').addClass('d-none')
        }
    }

    $(".validate-receiver-package").change(function () {
        const inputRelated = $(this).data('input-related')
        const valueToCheck = $(this).data('value-to-check')
        const isValue = $(this).val()
        const form = $(this).parents('form')
        const urlApi = $(this).data('url-api')

        console.log(isValue)
        if (isValue === valueToCheck) {

            validateZipcode(inputRelated, urlApi)

            $(inputRelated).change(function () {
                validateZipcode(inputRelated, urlApi)
            })

            $("#package-length, #package-width, #package-height, #package-weight").each(function () {
                const dropdownTarget = $(this).parents('.parent-validate-package').data('dropdown-target')
                const optionToDisable = $(this).parents('.parent-validate-package').data('option-to-disable')

                $(this).change(function () {
                    if ($(this).val() != '') {


                        let packHeight = $('#package-height').val()
                        let packWidth = $('#package-width').val()
                        let packLength = $('#package-length').val()
                        let packWeight = $("#package-weight").val()
                        let isValueAlreadyInRange = packWeight > 4 && packWeight < 23

                        let totalDimension = Number(packHeight) + Number(packLength) + Number(packWidth)
                        console.log(`totalDimension: ${totalDimension}`)

                        if (totalDimension > 150 || !isValueAlreadyInRange) {
                            console.log('total dimensi atau berat melebihi syarat', dropdownTarget, optionToDisable)
                            $(`${dropdownTarget} option[value="${optionToDisable}"]`).prop('disabled', true)

                        } else {
                            console.log('total dimensi atau berat lolos syarat', dropdownTarget, optionToDisable)
                            $(`${dropdownTarget} option[value="${optionToDisable}"]`).prop('disabled', false)
                        }

                        $(dropdownTarget).trigger('change')
                    }
                })
            })

        } else {
            $(`.error-ajax-${$(inputRelated).attr('name')}`).text('').addClass('d-none').removeClass('d-block')

            if (!$('#select-courier').hasClass('d-none')) {
                $('#select-courier').addClass('d-none')
            }
        }
    })



})
