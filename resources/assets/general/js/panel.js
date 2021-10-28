$(document).ready(function () {
    $(".btn-close--div").click(function () {
        const divToClose = $(this).data('close-div')
        $(divToClose).hide('slow')

        if ($(this).data('section-closed-aos')) {
            const sectionClosed = $(this).data('section-closed-aos')
            $(sectionClosed).addClass('aos-animate')
        }
    })

    $(".panel-scroll__right .panel-scroll__text").each(function () {
        const heightPanelItem = $(this).outerHeight()
        const panelId = $(this).attr('id')

        console.log(panelId, heightPanelItem)

        $(`.panel-scroll__left .panel-scroll__item[data-panel-attached='#${panelId}']`)
        .css('height', `${heightPanelItem}px`)
    })

})
