<?= view('templates/public/header_public.php') ?>

<div class="container mt-4 mb-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">Selamat Datang di</span>
            <h1 class="display-4 fw-bolder mb-3">Marketplace <br><span class="text-primary">Barang Preloved</span> Mahasiswa</h1>
            <p class="lead text-muted mb-4">Temukan barang-barang berkualitas dari sesama mahasiswa dengan harga miring. Dari buku kuliah hingga perlengkapan kos.</p>
            <div class="d-flex gap-3">
                <a href="<?= base_url('produk') ?>" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">Mulai Belanja</a>
                <a href="<?= base_url('tentang') ?>" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div id="carouselExampleIndicators" class="carousel slide rounded-4 overflow-hidden shadow" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= base_url('assets/images/sport.jpg') ?>" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url('assets/images/shoes.jpg') ?>" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url('assets/images/keychain.jpg') ?>" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>

    <div class="row mb-4 mt-5 pt-4">
        <div class="col-12 text-center mb-4">
            <h2 class="fw-bold">Produk <span class="text-primary">Terbaru</span></h2>
            <p class="text-muted">Barang preloved yang baru saja ditambahkan</p>
        </div>
        
        <div class="row g-4" id="produk-terbaru-container">
            <div class="col-12 text-center text-muted py-4" id="produk-loading">
                <p>Memuat produk...</p>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-3 mb-5 pb-5">
        <a href="<?= base_url('produk') ?>" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold shadow-sm">Lihat Semua Produk <i class="bi bi-arrow-right ms-2"></i></a>
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        url: base_url + 'api/produk',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(p) {
                    let img = base_url + 'assets/uploads/' + p.gambar;
                    let link = base_url + 'produk/' + p.slug;
                    let badge = p.nama_kategori ? '<span class="badge bg-light text-dark border">' + p.nama_kategori + '</span>' : '';
                    let price = new Intl.NumberFormat('id-ID').format(p.harga);
                    html += '<div class="col-md-4 col-lg-3">';
                    html += '<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">';
                    html += '<div class="position-relative"><img src="' + img + '" class="card-img-top object-fit-cover" height="200" alt="' + p.nama + '"><span class="badge bg-primary position-absolute top-0 start-0 m-3">' + p.kondisi + '</span></div>';
                    html += '<div class="card-body"><div class="mb-2">' + badge + '</div>';
                    html += '<h5 class="card-title fw-bold text-truncate"><a href="' + link + '" class="text-decoration-none text-body">' + p.nama + '</a></h5>';
                    html += '<h4 class="text-primary fw-bolder mt-3">Rp ' + price + '</h4></div>';
                    html += '<div class="card-footer border-0 pb-3 pt-0"><a href="' + link + '" class="btn btn-outline-primary w-100 rounded-pill fw-semibold">Lihat Detail</a></div>';
                    html += '</div></div>';
                });
                $('#produk-terbaru-container').html(html);
            } else {
                $('#produk-loading').html('<p class="text-muted">Belum ada produk.</p>');
            }
        },
        error: function() {
            $('#produk-loading').html('<p class="text-muted">Gagal memuat produk.</p>');
        }
    });
});
</script>

<style>
.product-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
.product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>

<?= view('templates/public/footer_public.php') ?>
