    <footer class="container-fluid border-top" id="footer">
        <div class="container d-flex justify-content-between"
        style="padding-top: 3rem; padding-bottom: 7rem;"
        >
        <div class="row w-100">
            <div class="col-12 col-lg-4 pb-2">
                <h1 class="fw-bolder">PRELOVED <span class="text-primary">UKRIDA</span></h1> <br>
                Platform jual beli barang preloved terpercaya. Temukan barang berkualitas dengan harga terbaik.
                <div class="social-media d-flex gap-3">
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-whatsapp"></i></a>
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
                <div class="col-6 col-lg-2 ms-auto mt-4 mt-lg-0">
                    <h5 class="fw-bold mb-3">Navigasi</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><a href="<?= base_url() ?>" class="text-decoration-none text-muted">Beranda</a></li>
                        <li class="mb-2"><a href="<?= base_url('produk') ?>" class="text-decoration-none text-muted">Marketplace</a></li>
                        <li class="mb-2"><a href="<?= base_url('berita') ?>" class="text-decoration-none text-muted">Berita</a></li>
                        <li class="mb-2"><a href="<?= base_url('galeri') ?>" class="text-decoration-none text-muted">Galeri</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 mt-4 mt-lg-0">
                    <h5 class="fw-bold mb-3">Bantuan</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><a href="<?= base_url('tentang') ?>" class="text-decoration-none text-muted">Tentang Kami</a></li>
                        <li class="mb-2"><a href="<?= base_url('kontak') ?>" class="text-decoration-none text-muted">Hubungi Kami</a></li>
                    </ul>
                </div>
        </div>
        </div>
        
        <div class="text-center py-3 border-top mt-4 text-muted small">
            &copy; <?= date('Y') ?> Preloved Ukrida. All rights reserved.
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src=<?= base_url('assets/js/theme.js') ?>></script>
</body>
</html>
