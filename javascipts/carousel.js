document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.slide');

    let currentIndex = 0;

    function nextSlide() {
        slides[currentIndex].style.display = 'none';
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].style.display = 'block';
    }

    setInterval(nextSlide, 5000); // Change de diapositive toutes les 5 secondes
});
