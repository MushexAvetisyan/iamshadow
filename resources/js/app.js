import './bootstrap.js';

const addEventOnElements = (elements, eventType, callback) => {
    for (let i = 0, len = elements.length; i < len; i++) {
        elements[i].addEventListener(eventType, callback);
    }
};

/*Theme Toggle*/
document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    const themePreference = localStorage.getItem('themePreference');

    if (themePreference) {
        body.classList.add(themePreference);
        if (themePreference === 'dark-mode') {
            themeToggle.checked = true;
            moveToggleToRight();
        }
    }

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        localStorage.setItem('themePreference', body.classList.contains('dark-mode') ? 'dark-mode' : '');
        moveToggleToRight();
    });

    function moveToggleToRight() {
        const toggleWidth = themeToggle.offsetWidth;
        if (themeToggle.checked) {
            themeToggle.nextElementSibling.style.transform = `translateX(${toggleWidth}px)`;
        } else {
            themeToggle.nextElementSibling.style.transform = '';
        }
    }
});

const backTopBtn = document.querySelector("[data-back-top-btn]");

window.addEventListener("scroll", () => {
    if (window.scrollY > 100) {
        backTopBtn.classList.add("active");
    } else {
        backTopBtn.classList.remove("active");
    }
});

/*HEADER SCROLLING*/
const headerSmooth = document.getElementById("header-menu");
window.addEventListener("scroll", () => {
    const scrollPos = window.pageYOffset;
    scrollPos > 50 ? headerSmooth.classList.add("scrolled") : headerSmooth.classList.remove("scrolled");
});


if (toast) {
    if (toast.innerText.trim() !== '') {
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 5000);
    }
}


/*MODAL*/
document.addEventListener('DOMContentLoaded', () => {
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('myModal');

    openModalBtn.addEventListener('click', () => { modal.style.display = 'flex'; });
    closeModalBtn.addEventListener('click', () => { modal.style.display = 'none'; });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            // modal.style.display = 'none'; // Uncomment if you want to close the modal when clicking outside
        }
    });
});

/*NAVBAR Toggle*/
const navbar = document.querySelector("[data-navbar]");
const navTogglers = document.querySelectorAll("[data-nav-toggler]");

const toggleNav = () => {
    navbar.classList.toggle("active");
    document.body.classList.toggle("nav-active");
};

addEventOnElements(navTogglers, "click", toggleNav);

const buttons = document.querySelectorAll(".card-buttons button");
const sections = document.querySelectorAll(".card-section");
const card = document.querySelector(".card");

const handleButtonClick = (e) => {
    const targetSection = e.target.getAttribute("data-section");
    const section = document.querySelector(targetSection);
    targetSection !== "#about" ? card.classList.add("is-active") : card.classList.remove("is-active");
    card.setAttribute("data-state", targetSection);
    sections.forEach((s) => s.classList.remove("is-active"));
    buttons.forEach((b) => b.classList.remove("is-active"));
    e.target.classList.add("is-active");
    section.classList.add("is-active");
};

buttons.forEach((btn) => {
    btn.addEventListener("click", handleButtonClick);
});

const handleDropdownHover = (containerId) => {
    const dropdownContainer = document.getElementById(containerId);
    if (!dropdownContainer) {
        console.log(containerId + ' not found');
        return;
    }

    const itemList = dropdownContainer.querySelector('.item-list');
    if (!itemList) {
        console.log(containerId + ' .item-list not found');
        return;
    }
    const checkbox = dropdownContainer.querySelector('.menu-button');

    dropdownContainer.addEventListener('mouseover', () => {
        console.log(containerId + ' mouseover');
        itemList.style.transform = 'translateX(-50%) scale(1)';
        itemList.style.opacity = '1';
        checkbox.checked = true;
    });

    dropdownContainer.addEventListener('mouseout', () => {
        itemList.style.transform = 'translateX(-50%) scale(0)';
        itemList.style.opacity = '0';
        checkbox.checked = false;
    });
};
