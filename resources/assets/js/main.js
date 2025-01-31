// Initialize AOS
import AOS from "aos";
import mixitup from "mixitup";
window.addEventListener("load", () => {
    AOS.init({
        duration: 1000,
        easing: "ease-in-out",
        once: true,
        mirror: false,
        offset: 0,
    });

    // Back to Top Button
    const backToTopBtn = document.querySelector(".back-to-top");

    if (backToTopBtn) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 150) {
                backToTopBtn.style.opacity = 1;
                backToTopBtn.style.visibility = "visible";
            } else {
                backToTopBtn.style.opacity = 0;
                backToTopBtn.style.visibility = "hidden";
            }
        });

        backToTopBtn.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }

    // Initialize Mixitup
    const portfolioContainer = document.querySelector(".filtered-portfolio");
    if (portfolioContainer) {
        var mixer = mixitup(portfolioContainer);
    }
});
