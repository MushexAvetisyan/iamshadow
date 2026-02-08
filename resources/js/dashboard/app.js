const sideMenu = document.querySelector("aside")
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none'
})

themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active')

    const isDark = document.body.classList.contains('dark-theme-variables');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
});

const preferredTheme = localStorage.getItem('theme');
if(preferredTheme === 'dark') {
    document.body.classList.add('dark-theme-variables');
    themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
    themeToggler.querySelector('span:nth-child(2)').classList.add('active');
}
else {
    themeToggler.querySelector('span:nth-child(1)').classList.add('active');
    themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
}




/*ERRORS AND NOTIFICATION*/
let updateAllert = document.getElementById('toast');
if (updateAllert) {
    setTimeout(() => {
        updateAllert.style.display = 'none';
    }, 3000)
}

let updateErrors = document.getElementById('errors');
if (updateErrors) {
    setTimeout(() => {
        updateErrors.style.display = 'none';
    }, 10000)
}




/*ACTIVE NAV LINKS*/
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', e => {
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        e.target.classList.add('active');
    });
});
