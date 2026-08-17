        <!-- Sidebar -->
        <div class="sidebar offcanvas-lg offcanvas-start border-end bg-body" tabindex="-1" id="admin-sidebar" aria-labelledby="admin-sidebar-label">
            <div class="offcanvas-header d-lg-none border-bottom">
                <h5 class="offcanvas-title fw-bold" id="admin-sidebar-label">Admin Panel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#admin-sidebar" aria-label="Tutup menu admin"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-3">
                <div class="d-none d-lg-flex align-items-center mb-4 mt-2">
                    <img src="<?= base_url('assets/images/logo_hitam.png') ?>" alt="Logo" height="35" class="me-2" id="logo-sidebar">
                    <h5 class="m-0 fw-bold">Admin Panel</h5>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted text-uppercase fw-semibold px-3">Menu Utama</small>
                </div>

                <ul class="nav nav-pills flex-column gap-1 mb-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('administrator/dashboard') ?>" class="nav-link <?= (url_is('administrator') || url_is('administrator/dashboard')) ? 'active' : 'text-body' ?>">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('administrator/produk') ?>" class="nav-link <?= url_is('administrator/produk*') ? 'active' : 'text-body' ?>">
                            <i class="bi bi-box-seam me-2"></i> Kelola Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('administrator/kategori') ?>" class="nav-link <?= url_is('administrator/kategori*') ? 'active' : 'text-body' ?>">
                            <i class="bi bi-tags me-2"></i> Kelola Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('administrator/berita') ?>" class="nav-link <?= url_is('administrator/berita*') ? 'active' : 'text-body' ?>">
                            <i class="bi bi-newspaper me-2"></i> Kelola Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('administrator/galeri') ?>" class="nav-link <?= url_is('administrator/galeri*') ? 'active' : 'text-body' ?>">
                            <i class="bi bi-images me-2"></i> Kelola Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('administrator/pesan') ?>" class="nav-link <?= url_is('administrator/pesan*') ? 'active' : 'text-body' ?>">
                            <i class="bi bi-envelope me-2"></i> Pesan Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('administrator/user') ?>" class="nav-link <?= url_is('administrator/user*') ? 'active' : 'text-body' ?>">
                            <i class="bi bi-people me-2"></i> Kelola User
                        </a>
                    </li>
                </ul>

                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-body" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('nama')) ?>&background=random" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?= esc(session()->get('nama')) ?></strong>
                    </a>
                    <ul class="dropdown-menu shadow">
                        <li><a class="dropdown-item" href="<?= base_url() ?>" target="_blank"><i class="bi bi-globe me-2"></i>Lihat Website</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-content flex-grow-1 min-vh-100 bg-body-tertiary">
            <nav class="navbar navbar-expand-lg border-bottom bg-body px-3 px-lg-4 py-3 admin-topbar">
                <div class="container-fluid">
                    <div class="d-flex align-items-center gap-2 min-w-0">
                        <button class="btn btn-outline-primary rounded-circle d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#admin-sidebar" aria-controls="admin-sidebar" aria-label="Buka menu admin">
                            <i class="bi bi-list"></i>
                        </button>
                        <h4 class="m-0 fw-semibold text-truncate admin-page-title"><?= esc($title ?? 'Dashboard') ?></h4>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button id="theme-toggle" class="btn rounded-circle border">
                            <i class="bi bi-moon-fill" id="theme-icon"></i>
                        </button>
                    </div>
                </div>
            </nav>
            <div class="p-3 p-lg-4 admin-content">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i> <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-1"></i> <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
