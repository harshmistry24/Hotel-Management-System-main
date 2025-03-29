let currentIndex = 0;
const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

// Clone first and last slides for smooth infinite transition
const firstClone = slides[0].cloneNode(true);
const lastClone = slides[totalSlides - 1].cloneNode(true);

// Add clones to the slider
slider.appendChild(firstClone);
slider.insertBefore(lastClone, slides[0]);

const allSlides = document.querySelectorAll('.slide'); // Update slide count
const totalSlidesWithClones = allSlides.length;

// Adjust slider position to the first original slide
slider.style.transform = `translateX(-100%)`;

function showSlide(index) {
    currentIndex = index;
    slider.style.transition = "transform 0.8s ease-in-out";
    slider.style.transform = `translateX(-${(currentIndex + 1) * 100}%)`;

    // Reset transition at the edges for smooth looping
    setTimeout(() => {
        if (currentIndex >= totalSlides) {
            slider.style.transition = "none";
            currentIndex = 0;
            slider.style.transform = `translateX(-100%)`;
        } else if (currentIndex < 0) {
            slider.style.transition = "none";
            currentIndex = totalSlides - 1;
            slider.style.transform = `translateX(-${totalSlides * 100}%)`;
        }
    }, 800);
}

function nextSlide() {
    showSlide(currentIndex + 1);
}

function prevSlide() {
    showSlide(currentIndex - 1);
}

// Auto slide every 3 seconds
setInterval(nextSlide, 3000);