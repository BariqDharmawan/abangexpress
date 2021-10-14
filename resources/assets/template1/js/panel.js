$(".btn-close--div").click(function () {
    const divToClose = $(this).data('close-div')
    $(divToClose).hide('slow')
})