$(".btn-close--div").click(function () {
    const divToClose = $(this).data('close-div')
    $(divToClose).hide('slow')

    if ($(this).data('section-closed-aos')) {
        const sectionClosed = $(this).data('section-closed-aos')
        $(sectionClosed).addClass('aos-animate')
    }
})