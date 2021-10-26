import AOS from 'aos';

/**
 * Animation on scroll
 */
window.addEventListener('load', () => {
    AOS.init({
        duration: 1000,
        easing: "ease-in-out",
        once: true,
        mirror: false
    });
});

export {AOS}