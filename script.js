const header = document.querySelector('header'); 
function fixedNavbar() { 
    header.classList.toggle('scroll', window.pageYOffset > 0); 
} 
fixedNavbar(); 
window.addEventListener('scroll', fixedNavbar); 

let menu = document.querySelector('#menu-btn'); 
let userBtn = document.querySelector('#user-btn'); 

menu.addEventListener('click', function () { 
    let nav = document.querySelector('.navbar'); 
    nav.classList.toggle('active'); 
}); 

userBtn.addEventListener('click', function () { 
    let userBox = document.querySelector('.user-box'); 
    userBox.classList.toggle('active'); 
});

/* Slider Functionality */
"use strict"; 
const leftArrow = document.querySelector('.left-arrow '); 
const rightArrow = document.querySelector('.right-arrow '); 
const slider = document.querySelector('.slider'); 


function scrollRight() { 
    if (slider.scrollWidth - slider.clientWidth === slider.scrollLeft) { 
        slider.scrollTo({ 
            left: 0, 
            behavior: "smooth" 
        }); 
    } else { 
        slider.scrollBy({ 
            left: window.innerWidth, 
            behavior: "smooth" 
        }); 
    }
}

function scrollLeft() { 
    slider.scrollBy({ 
        left: -window.innerWidth, 
        behavior: "smooth" 
    }); 
}  

let timerId = setInterval(scrollRight, 7000); 

function resetTimer() { 
    clearInterval(timerId); 
    timerId = setInterval(scrollRight, 7000); 
}
leftArrow.addEventListener('click', function () { 
    scrollLeft(); 
    resetTimer(); 
});

rightArrow.addEventListener('click', function () { 
    scrollRight(); 
    resetTimer(); 
});
/*--------testimonial slider-*/ 
let slides = document.querySelectorAll('.testimonial-item');
let index = 0;

// Function to show the next slide
function nextSlide() {
    slides[index].classList.remove('active'); // Remove active class from current slide
    index = (index + 1) % slides.length;     // Move to the next slide (circular navigation)
    slides[index].classList.add('active');   // Add active class to the new slide
}

// Function to show the previous slide
function prevSlide() {
    slides[index].classList.remove('active'); // Remove active class from current slide
    index = (index - 1 + slides.length) % slides.length; // Move to the previous slide (circular navigation)
    slides[index].classList.add('active');   // Add active class to the new slide
}



