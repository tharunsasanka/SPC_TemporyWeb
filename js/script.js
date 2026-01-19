document.addEventListener('DOMContentLoaded', () => {
    
    // 1. SELECT ELEMENTS
    const toggleBtn = document.getElementById('theme-toggle');
    const logoImg = document.getElementById('site-logo');
    const body = document.body;
    const icon = toggleBtn ? toggleBtn.querySelector('i') : null;

    // 2. CHECK LOCAL STORAGE (Remember user preference)
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) {
        body.setAttribute('data-theme', currentTheme);
        if (currentTheme === 'dark') {
            if(icon) { icon.classList.remove('fa-moon'); icon.classList.add('fa-sun'); }
            if(logoImg) logoImg.src = 'assets/images/logo-dark.png';
        }
    }

    // 3. CLICK EVENT (The Switch)
    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            if (body.getAttribute('data-theme') === 'dark') {
                // Switch to Light
                body.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
                if(icon) { icon.classList.remove('fa-sun'); icon.classList.add('fa-moon'); }
                if(logoImg) logoImg.src = 'assets/images/logo-light.png';
            } else {
                // Switch to Dark
                body.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                if(icon) { icon.classList.remove('fa-moon'); icon.classList.add('fa-sun'); }
                if(logoImg) logoImg.src = 'assets/images/logo-dark.png';
            }
        });
    }

    // 4. ACTIVE LINK HIGHLIGHTER
    const currentPage = window.location.pathname.split("/").pop();
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(link => {
        if (link.getAttribute('href') === currentPage || (currentPage === '' && link.getAttribute('href') === 'index.php')) {
            link.classList.add('active');
        }
    });
});