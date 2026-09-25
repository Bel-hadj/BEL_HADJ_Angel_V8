document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');

    if (slides.length === 0) {
        return; // Pas de carrousel sur cette page
    }

    let currentIndex = 0;
    slides.forEach((slide, index) => {
        slide.classList.toggle('active', index === 0);
    });

    function nextSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    setInterval(nextSlide, 5000); // Change de diapositive toutes les 5 secondes (fondu enchaîné)
});
