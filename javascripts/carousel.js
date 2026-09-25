document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');

    if (slides.length === 0) {
        return; // Pas de carrousel sur cette page
    }

    let currentIndex = 0;
    slides.forEach((slide, index) => {
        slide.style.display = index === 0 ? 'block' : 'none';
    });

    function nextSlide() {
        slides[currentIndex].style.display = 'none';
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].style.display = 'block';
    }

    setInterval(nextSlide, 5000); // Change de diapositive toutes les 5 secondes
});
