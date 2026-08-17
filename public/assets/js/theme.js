const html = document.documentElement;
const toggle = document.getElementById('theme-toggle');
const icon = document.getElementById('theme-icon');
const logoHeader = document.getElementById('logo-header');
const logoHitam = "/assets/images/logo_hitam.png";
const logoPutih = "/assets/images/logo_putih.png";

toggle.addEventListener('click', () => {
    const current = html.getAttribute('data-bs-theme');

    let themeToSave = '';
    if (current === 'light') {
        html.setAttribute('data-bs-theme', 'dark');
        icon.classList.remove('bi-moon-fill');
        icon.classList.add('bi-sun-fill');
        logoHeader.src = logoPutih;
        themeToSave = 'dark';
    } else {
        html.setAttribute('data-bs-theme', 'light');
        icon.classList.remove('bi-sun-fill');
        icon.classList.add('bi-moon-fill');
        logoHeader.src = logoHitam;
        themeToSave = 'light';
    }

    localStorage.setItem('theme', themeToSave);
});

html.setAttribute(
    'data-bs-theme',
    localStorage.getItem('theme') || 'light'
);

