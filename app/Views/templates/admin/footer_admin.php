            </div> 
        </div> 
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const html = document.documentElement;
        const toggle = document.getElementById('theme-toggle');
        const icon = document.getElementById('theme-icon');
        const logoSidebar = document.getElementById('logo-sidebar');
        const logoHitam = "<?= base_url('assets/images/logo_hitam.png') ?>";
        const logoPutih = "<?= base_url('assets/images/logo_putih.png') ?>";

        function setTheme(theme) {
            html.setAttribute('data-bs-theme', theme);
            localStorage.setItem('admin-theme', theme);
            if (theme === 'dark') {
                icon.classList.remove('bi-moon-fill');
                icon.classList.add('bi-sun-fill');
                if(logoSidebar) logoSidebar.src = logoPutih;
            } else {
                icon.classList.remove('bi-sun-fill');
                icon.classList.add('bi-moon-fill');
                if(logoSidebar) logoSidebar.src = logoHitam;
            }
        }

        const savedTheme = localStorage.getItem('admin-theme') || 'light';
        setTheme(savedTheme);

        toggle.addEventListener('click', () => {
            const current = html.getAttribute('data-bs-theme');
            setTheme(current === 'light' ? 'dark' : 'light');
        });

    </script>
</body>
</html>
