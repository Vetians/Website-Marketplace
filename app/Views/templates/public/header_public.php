<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Preloved Ukrida') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <!-- font poppins -->
    <link rel="stylesheet"href="<?= base_url('assets/css/style.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>const base_url = "<?= base_url() ?>";</script>
</head> 
<body>
    <div class="first-navbar container d-flex justify-content-end mt-2">
        <div>
            <?php if(session()->get('isLoggedIn')): ?>
                <a href="<?= base_url('administrator/dashboard') ?>" class="me-3 fw-bold text-decoration-none">Admin Panel</a>
                <a href="<?= base_url('logout') ?>" class="text-danger text-decoration-none">Logout</a>
            <?php else: ?>
                <a href="<?= base_url('login') ?>" class="me-3 text-decoration-none">Login Admin</a>
                <a href="<?= base_url('register') ?>" class="text-decoration-none">Daftar Admin</a>
            <?php endif; ?>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl sticky-top mt-1">
        <div class="second-navbar container rounded-pill border border-3 px-3 py-2 bg-body">
            <a class="navbar-brand fw-bolder d-flex align-items-center me-2" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/images/logo_putih.png') ?>" alt="Logo" height="45" id="logo-header">
                <span class="ms-1">Preloved <span class="text-primary">UKRIDA</span></span>
            </a>
            <button class="navbar-toggler flex-shrink-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <div class="d-flex flex-column flex-xl-row align-items-stretch align-items-xl-center gap-3 w-100 justify-content-xl-end pt-3 pt-xl-0">
                    <ul class="navbar-nav align-items-xl-center gap-xl-1">
                        <li class="nav-item"><a class="nav-link <?= url_is('/') ? 'active fw-bold' : '' ?>" href="<?= base_url() ?>">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link <?= url_is('produk*') ? 'active fw-bold' : '' ?>" href="<?= base_url('produk') ?>">Produk</a></li>
                        <li class="nav-item"><a class="nav-link <?= url_is('berita*') ? 'active fw-bold' : '' ?>" href="<?= base_url('berita') ?>">Berita</a></li>
                        <li class="nav-item"><a class="nav-link <?= url_is('galeri*') ? 'active fw-bold' : '' ?>" href="<?= base_url('galeri') ?>">Galeri</a></li>
                        <li class="nav-item"><a class="nav-link <?= url_is('tentang') ? 'active fw-bold' : '' ?>" href="<?= base_url('tentang') ?>">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link <?= url_is('kontak') ? 'active fw-bold' : '' ?>" href="<?= base_url('kontak') ?>">Kontak</a></li>
                    </ul>
                    <form class="d-flex flex-grow-1 flex-xl-grow-0 public-search-form" action="<?= base_url('produk') ?>" method="GET">
                        <input class="form-control rounded-pill" type="search" name="q" placeholder="Cari barang..." value="<?= esc($_GET['q'] ?? '') ?>">
                        <button class="btn btn-outline-primary rounded-pill px-3 ms-2 flex-shrink-0" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                    <button id="theme-toggle" class="btn rounded-circle border align-self-start align-self-xl-center flex-shrink-0">
                        <i class="bi bi-sun-fill" id="theme-icon"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
