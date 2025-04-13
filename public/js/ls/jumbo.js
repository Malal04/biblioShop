document.addEventListener("DOMContentLoaded", function() {
    const images = document.querySelectorAll(".jumbo_image img");
    let index = 0;
    
    function changeImage() {
        images.forEach(img => img.classList.remove("active"));
        images[index].classList.add("active");
        index = (index + 1) % images.length;
    }
    
    changeImage();
    setInterval(changeImage, 3000);
});

function toggleDropdown(event) {
    event.preventDefault();
    const dropdownMenu = event.currentTarget.nextElementSibling;
    dropdownMenu.classList.toggle('hidden');
}

const hamburger = document.querySelector('.hamburger');
const menu = document.querySelector('.header_menu');

hamburger.addEventListener('click', () => {
    menu.classList.toggle('active');
});


// Optional: click outside to close dropdown
document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.dropdown');
    if (!dropdown.contains(event.target)) {
        dropdown.querySelector('.dropdown-menu').classList.add('hidden');
    }
});