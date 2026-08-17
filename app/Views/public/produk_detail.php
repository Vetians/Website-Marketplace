<?= view('templates/public/header_public.php') ?>

<div class="container mt-5 mb-5 pb-5" id="produk-detail-container">
    <div class="text-center py-5" id="produk-detail-loading">
        <p>Memuat detail produk...</p>
    </div>
</div>

<script>
$(document).ready(function() {
    const slug = window.location.pathname.split('/').pop();
    const container = $('#produk-detail-container');

    // 1. Load detail produk via API JSON
    $.ajax({
        url: base_url + 'api/produk/detail/' + slug,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200) {
                const p = res.data;
                let img = base_url + 'assets/uploads/' + p.gambar;
                let link = base_url + 'produk/' + p.slug;
                let price = new Intl.NumberFormat('id-ID').format(p.harga);
                let date = new Date(p.created_at);
                let dateStr = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });

                document.title = p.nama + ' | Preloved Ukrida';

                let html = '<nav aria-label="breadcrumb" class="mb-4">';
                html += '<ol class="breadcrumb">';
                html += '<li class="breadcrumb-item"><a href="' + base_url + '" class="text-decoration-none">Beranda</a></li>';
                html += '<li class="breadcrumb-item"><a href="' + base_url + 'produk" class="text-decoration-none">Marketplace</a></li>';
                html += '<li class="breadcrumb-item active" aria-current="page">' + p.nama + '</li>';
                html += '</ol></nav>';

                html += '<div class="row mb-5">';
                html += '<div class="col-lg-5 mb-4 mb-lg-0">';
                html += '<div class="card border-0 shadow-sm rounded-4 overflow-hidden">';
                html += '<img src="' + img + '" class="w-100 object-fit-cover" style="max-height: 500px;" alt="' + p.nama + '">';
                html += '</div></div>';
                html += '<div class="col-lg-7 px-lg-5">';
                html += '<div class="mb-3">';
                html += '<span class="badge bg-primary rounded-pill px-3 py-2 me-2">' + p.kondisi + '</span>';
                html += '<span class="badge bg-light text-dark border rounded-pill px-3 py-2">' + (p.nama_kategori || '') + '</span>';
                html += '</div>';
                html += '<h1 class="fw-bold mb-3">' + p.nama + '</h1>';
                html += '<h2 class="text-primary fw-bolder mb-4">Rp ' + price + '</h2>';
                html += '<div class="d-flex align-items-center mb-4 text-muted p-3 rounded-3">';
                html += '<div class="me-4"><i class="bi bi-box text-primary me-2"></i> Stok: <strong>' + p.stok + '</strong></div>';
                html += '<div><i class="bi bi-calendar-check text-primary me-2"></i> Diupload: <strong>' + dateStr + '</strong></div>';
                html += '</div>';
                html += '<div class="mb-5"><h5 class="fw-bold mb-3">Deskripsi Produk</h5>';
                html += '<p class="text-muted lh-lg" style="white-space: pre-wrap;">' + (p.deskripsi || '') + '</p></div>';
                html += '<div class="d-grid gap-2 d-md-flex mt-4">';
                html += '<a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20produk%20' + encodeURIComponent(p.nama) + '%20yang%20ada%20di%20Preloved%20Ukrida." target="_blank" class="btn btn-success btn-lg rounded-pill px-5 fw-bold shadow-sm">';
                html += '<i class="bi bi-whatsapp me-2"></i> Hubungi Penjual</a>';
                html += '<button class="btn btn-outline-secondary btn-lg rounded-circle" id="btn-share" data-bs-toggle="tooltip" title="Bagikan Produk"><i class="bi bi-share"></i></button>';
                html += '</div></div></div>';

                html += '<div class="mt-5 pt-5 border-top"><h4 class="fw-bold mb-4">Mungkin Anda Suka</h4>';
                html += '<div class="row g-4" id="produk-lain-container"><div class="col-12 text-center"><p class="text-muted">Memuat...</p></div></div></div>';

                container.html(html);

                $('[data-bs-toggle="tooltip"]').tooltip();
                $('#btn-share').click(function() {
                    if (navigator.share) {
                        navigator.share({ title: p.nama + ' di Preloved Ukrida', url: window.location.href });
                    } else {
                        alert('Fitur share tidak didukung di browser ini.');
                    }
                });

                // 2. Load produk lain via API JSON
                $.ajax({
                    url: base_url + 'api/produk',
                    type: 'GET',
                    dataType: 'json',
                    success: function(res2) {
                        if (res2.status == 200 && res2.data.length > 0) {
                            let html2 = '';
                            let count = 0;
                            res2.data.forEach(function(pl) {
                                if (pl.id == p.id || count >= 4) return;
                                count++;
                                let img2 = base_url + 'assets/uploads/' + pl.gambar;
                                let link2 = base_url + 'produk/' + pl.slug;
                                let price2 = new Intl.NumberFormat('id-ID').format(pl.harga);
                                html2 += '<div class="col-md-3">';
                                html2 += '<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">';
                                html2 += '<img src="' + img2 + '" class="card-img-top object-fit-cover" height="150" alt="' + pl.nama + '">';
                                html2 += '<div class="card-body">';
                                html2 += '<h6 class="card-title fw-bold text-truncate"><a href="' + link2 + '" class="text-decoration-none text-body">' + pl.nama + '</a></h6>';
                                html2 += '<h5 class="text-primary fw-bolder mb-0">Rp ' + price2 + '</h5>';
                                html2 += '</div></div></div>';
                            });
                            $('#produk-lain-container').html(html2 || '<div class="col-12 text-muted">Tidak ada produk terkait.</div>');
                        }
                    }
                });
            } else {
                container.html('<div class="text-center py-5"><h5>Produk tidak ditemukan.</h5><a href="' + base_url + 'produk" class="btn btn-primary mt-3 rounded-pill">Kembali ke Marketplace</a></div>');
            }
        },
        error: function() {
            container.html('<div class="text-center py-5"><h5>Gagal memuat produk.</h5><a href="' + base_url + 'produk" class="btn btn-primary mt-3 rounded-pill">Kembali ke Marketplace</a></div>');
        }
    });
});
</script>

<?= view('templates/public/footer_public.php') ?>
