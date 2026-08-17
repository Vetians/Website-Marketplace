<?= view('templates/public/header_public.php') ?>

<div class="container mt-4 mb-5">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold m-0">Marketplace</h2>
            <p class="text-muted mb-0">Temukan barang preloved incaranmu</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <?php if($keyword): ?>
                <span class="badge bg-primary px-3 py-2 rounded-pill me-2">Pencarian: "<?= esc($keyword) ?>"</span>
                <a href="<?= base_url('produk') ?>" class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-x"></i> Hapus Filter</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filter Kategori -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex gap-2 overflow-auto pb-2" id="kategori-container">
                <a href="<?= base_url('produk') ?>" class="btn rounded-pill px-4 <?= empty($kategori_slug) ? 'btn-primary' : 'btn-outline-primary' ?>">Semua</a>
            </div>
        </div>
    </div>

    <div class="row g-4" id="produk-container">
        <?php if($keyword && !empty($produk)): ?>
            <?php foreach($produk as $p): ?>
                <?php
                    $img = base_url('assets/uploads/' . $p['gambar']);
                    $link = base_url('produk/' . $p['slug']);
                    $price = number_format($p['harga'], 0, ',', '.');
                ?>
                <div class="col-md-4 col-lg-3 produk-item" data-kategori="<?= $p['kategori_id'] ?>">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">
                        <div class="position-relative">
                            <img src="<?= $img ?>" class="card-img-top object-fit-cover" height="200" alt="<?= esc($p['nama']) ?>">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-3"><?= $p['kondisi'] ?></span>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <?php if(!empty($p['nama_kategori'])): ?>
                                    <span class="badge bg-light text-dark border"><?= $p['nama_kategori'] ?></span>
                                <?php endif; ?>
                            </div>
                            <h5 class="card-title fw-bold text-truncate">
                                <a href="<?= $link ?>" class="text-decoration-none text-body"><?= esc($p['nama']) ?></a>
                            </h5>
                            <h4 class="text-primary fw-bolder mt-3">Rp <?= $price ?></h4>
                            <p class="small text-muted mb-0"><i class="bi bi-box"></i> Stok: <?= $p['stok'] ?></p>
                        </div>
                        <div class="card-footer border-0 pb-3 pt-0">
                            <a href="<?= $link ?>" class="btn btn-outline-primary w-100 rounded-pill fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php elseif($keyword && empty($produk)): ?>
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-search display-1 mb-3 opacity-25"></i>
                <h5>Tidak ada produk yang ditemukan.</h5>
            </div>
        <?php else: ?>
            <div class="col-12 text-center text-muted py-5" id="produk-loading">
                <p>Memuat produk...</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function() {
    const currentKategoriSlug = "<?= $kategori_slug ?? '' ?>";
    const keyword = "<?= $keyword ?? '' ?>";

    // 1. Load kategori via API JSON
    $.ajax({
        url: base_url + 'api/kategori',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200) {
                let html = '<a href="' + base_url + 'produk" class="btn rounded-pill px-4 ' + (currentKategoriSlug === '' ? 'btn-primary' : 'btn-outline-primary') + '">Semua</a>';
                res.data.forEach(function(kat) {
                    let isActive = kat.slug == currentKategoriSlug;
                    html += '<a href="' + base_url + 'produk/kategori/' + kat.slug + '" class="btn rounded-pill px-4 flex-shrink-0 ' + (isActive ? 'btn-primary' : 'btn-outline-primary') + '">' + kat.nama + '</a>';
                });
                $('#kategori-container').html(html);
            }
        }
    });

    // 2. Load produk via API JSON (hanya jika tidak ada keyword pencarian)
    if (keyword !== '') return;
    $.ajax({
        url: base_url + 'api/produk',
        type: 'GET',
        dataType: 'json',
        data: currentKategoriSlug ? { kategori_slug: currentKategoriSlug } : {},
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(p) {
                    let img = base_url + 'assets/uploads/' + p.gambar;
                    let link = base_url + 'produk/' + p.slug;
                    let badge = p.nama_kategori ? '<span class="badge bg-light text-dark border">' + p.nama_kategori + '</span>' : '';
                    let price = new Intl.NumberFormat('id-ID').format(p.harga);
                    html += '<div class="col-md-4 col-lg-3 produk-item" data-kategori="' + p.kategori_id + '">';
                    html += '<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">';
                    html += '<div class="position-relative"><img src="' + img + '" class="card-img-top object-fit-cover" height="200" alt="' + p.nama + '"><span class="badge bg-primary position-absolute top-0 start-0 m-3">' + p.kondisi + '</span></div>';
                    html += '<div class="card-body"><div class="mb-2">' + badge + '</div>';
                    html += '<h5 class="card-title fw-bold text-truncate"><a href="' + link + '" class="text-decoration-none text-body">' + p.nama + '</a></h5>';
                    html += '<h4 class="text-primary fw-bolder mt-3">Rp ' + price + '</h4>';
                    html += '<p class="small text-muted mb-0"><i class="bi bi-box"></i> Stok: ' + p.stok + '</p></div>';
                    html += '<div class="card-footer border-0 pb-3 pt-0"><a href="' + link + '" class="btn btn-outline-primary w-100 rounded-pill fw-semibold">Detail</a></div>';
                    html += '</div></div>';
                });
                $('#produk-container').html(html);
            } else {
                $('#produk-container').html('<div class="col-12 text-center text-muted py-5"><i class="bi bi-search display-1 mb-3 opacity-25"></i><h5>Tidak ada produk yang ditemukan.</h5></div>');
            }
        },
        error: function() {
            $('#produk-container').html('<div class="col-12 text-center text-muted py-5"><i class="bi bi-search display-1 mb-3 opacity-25"></i><h5>Gagal memuat produk.</h5></div>');
        }
    });
});
</script>

<style>
.product-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
.product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>

<?= view('templates/public/footer_public.php') ?>
