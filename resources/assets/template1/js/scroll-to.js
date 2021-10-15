const btnScrollTo = document.querySelectorAll('.scroll-to-section')
btnScrollTo.forEach(btn => {
    btn.addEventListener('click', () => {
        const scrollTo = btn.dataset.toSection
        document.querySelector(scrollTo).scrollIntoView();
    })
})