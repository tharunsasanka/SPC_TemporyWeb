<footer>
    <div class="footer-content">
        <h3>Sripalee College</h3>
        <p>Empowering the future generation of Sri Lanka.</p>
        <p>&copy; <?php echo date("Y"); ?> Sripalee College. All Rights Reserved Made with By Tharun Sasanka.</p>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Get Elements
    const toggleBtn = document.getElementById('theme-toggle');
    const body = document.body;
    const icon = toggleBtn ? toggleBtn.querySelector('i') : null;

    // 2. Load Saved Theme
    if(toggleBtn) {
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            body.setAttribute('data-theme', currentTheme);
            if (currentTheme === 'dark') {
                if(icon) { icon.classList.remove('fa-moon'); icon.classList.add('fa-sun'); }
            }
        }

        // 3. Click Event (Colors ONLY, No Logo Swap)
        toggleBtn.addEventListener('click', () => {
            if (body.getAttribute('data-theme') === 'dark') {
                // Switch to Light
                body.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
                if(icon) { icon.classList.remove('fa-sun'); icon.classList.add('fa-moon'); }
            } else {
                // Switch to Dark
                body.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                if(icon) { icon.classList.remove('fa-moon'); icon.classList.add('fa-sun'); }
            }
        });
    }

    // 4. Active Link Highlighter
    const currentPage = window.location.pathname.split("/").pop();
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(link => {
        if (link.getAttribute('href') === currentPage || (currentPage === '' && link.getAttribute('href') === 'index.php')) {
            link.classList.add('active');
        }
    });
});
</script>
</body>
</html>