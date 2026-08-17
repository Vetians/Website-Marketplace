<?= view('templates/public/header_public.php') ?>

<div class="container mt-5 mb-5 pb-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
            <h1 class="fw-bolder mb-4">Tentang <span class="text-primary">Preloved Ukrida</span></h1>
            <p class="lead text-muted mb-4">Preloved Ukrida adalah platform marketplace eksklusif untuk komunitas mahasiswa UKRIDA. Kami memfasilitasi transaksi jual beli barang bekas berkualitas dengan aman dan terpercaya.</p>
            <p class="text-muted">Misi kami adalah membantu mahasiswa dalam menekan pengeluaran selama kuliah dengan menyediakan sarana untuk membeli barang bekas layak pakai dengan harga terjangkau, dengan menerapkan re-use agar lingkungan tetap terjaga.</p>
        </div>
        <div class="col-lg-6">
            <img src="<?= base_url('assets/images/logo.png') ?>" class="w-100 rounded-4 shadow" alt="Tentang Kami">
        </div>
    </div>

    <div class="row mt-5 pt-4 text-center">
        <div class="col-md-4 mb-4">
            <div class="p-4 rounded-4 h-100">
                <i class="bi bi-shield-check display-4 text-primary mb-3"></i>
                <h4 class="fw-bold">Aman & Terpercaya</h4>
                <p class="text-muted">Transaksi mahasiswa diperantarai oleh pihak ketiga yang resmi dari kampus UKRIDA. Mencegah kecurangan dari pihak manapun yang terlibat transaksi.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 rounded-4 h-100">
                <i class="bi bi-wallet2 display-4 text-primary mb-3"></i>
                <h4 class="fw-bold">Harga Mahasiswa</h4>
                <p class="text-muted">Temukan harga terbaik yang ramah kantong. Tidak perlu khawatir overbudget untuk keperluan kuliah.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 rounded-4 h-100">
                <i class="bi bi-recycle display-4 text-primary mb-3"></i>
                <h4 class="fw-bold">Go Green</h4>
                <p class="text-muted">Dukung gerakan go green dengan membeli barang preloved dan mengurangi limbah barang bekas.</p>
            </div>
        </div>
    </div>
</div>

<?= view('templates/public/footer_public.php') ?>
