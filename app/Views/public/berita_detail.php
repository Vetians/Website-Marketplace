<?= view('templates/public/header_public.php') ?>

<div class="container mt-5 mb-5 pb-5" id="berita-detail-container">
    <div class="text-center py-5">
        <p>Memuat berita...</p>
    </div>
</div>

<script>
$(document).ready(function() {
    const slug = window.location.pathname.split('/').pop();
    const container = $('#berita-detail-container');

    $.ajax({
        url: base_url + 'api/berita/detail/' + slug,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200) {
                const b = res.data;
                let img = base_url + 'assets/uploads/' + b.gambar;
                let date = new Date(b.created_at);
                let dateStr = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) + ', ' + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                document.title = b.judul + ' | Preloved Ukrida';

                let html = '<nav aria-label="breadcrumb" class="mb-4">';
                html += '<ol class="breadcrumb">';
                html += '<li class="breadcrumb-item"><a href="' + base_url + '" class="text-decoration-none">Beranda</a></li>';
                html += '<li class="breadcrumb-item"><a href="' + base_url + 'berita" class="text-decoration-none">Berita</a></li>';
                html += '<li class="breadcrumb-item active">' + b.judul + '</li>';
                html += '</ol></nav>';

                html += '<div class="row justify-content-center"><div class="col-lg-8">';
                html += '<h1 class="fw-bold mb-3">' + b.judul + '</h1>';
                html += '<div class="d-flex align-items-center text-muted mb-4"><i class="bi bi-calendar3 me-2"></i> ' + dateStr + '</div>';
                html += '<img src="' + img + '" class="w-100 rounded-4 mb-4 shadow-sm" alt="' + b.judul + '">';
                html += '<div class="article-content lh-lg" style="font-size: 1.1rem;">' + (b.konten || '') + '</div>';
                html += '<div class="mt-5 border-top pt-4">';
                html += '<div class="d-flex justify-content-between align-items-center">';
                html += '<span class="fw-bold">Bagikan artikel ini:</span>';
                html += '<div class="d-flex gap-2">';
                html += '<a href="https://wa.me/?text=' + encodeURIComponent(b.judul + ' - ' + window.location.href) + '" target="_blank" class="btn btn-outline-success rounded-circle"><i class="bi bi-whatsapp"></i></a>';
                html += '<a href="https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href) + '&text=' + encodeURIComponent(b.judul) + '" target="_blank" class="btn btn-outline-dark rounded-circle"><i class="bi bi-twitter-x"></i></a>';
                html += '</div></div></div></div></div>';

                html += '<div class="mt-5 pt-5 border-top"><h4 class="fw-bold mb-4">Berita Lainnya</h4>';
                html += '<div class="row g-4" id="berita-lain-container"><div class="col-12"><p class="text-muted">Memuat...</p></div></div></div>';

                container.html(html);

                // Load berita lain via API
                $.ajax({
                    url: base_url + 'api/berita',
                    type: 'GET',
                    dataType: 'json',
                    success: function(res2) {
                        if (res2.status == 200 && res2.data.length > 0) {
                            let html2 = '';
                            let count = 0;
                            res2.data.forEach(function(bl) {
                                if (bl.id == b.id || count >= 3) return;
                                count++;
                                let img2 = base_url + 'assets/uploads/' + bl.gambar;
                                let link2 = base_url + 'berita/' + bl.slug;
                                let date2 = new Date(bl.created_at);
                                let dateStr2 = date2.toLocaleDateString('id-ID', { day: 'short', month: 'short', year: 'numeric' });
                                html2 += '<div class="col-md-4">';
                                html2 += '<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">';
                                html2 += '<img src="' + img2 + '" class="card-img-top object-fit-cover" height="150" alt="' + bl.judul + '">';
                                html2 += '<div class="card-body">';
                                html2 += '<h6 class="card-title fw-bold"><a href="' + link2 + '" class="text-decoration-none text-body stretched-link">' + bl.judul + '</a></h6>';
                                html2 += '<small class="text-muted">' + dateStr2 + '</small>';
                                html2 += '</div></div></div>';
                            });
                            $('#berita-lain-container').html(html2 || '<div class="col-12 text-muted">Tidak ada berita lain.</div>');
                        }
                    }
                });
            } else {
                container.html('<div class="text-center py-5"><h5>Berita tidak ditemukan.</h5><a href="' + base_url + 'berita" class="btn btn-primary mt-3 rounded-pill">Kembali ke Berita</a></div>');
            }
        },
        error: function() {
            container.html('<div class="text-center py-5"><h5>Gagal memuat berita.</h5><a href="' + base_url + 'berita" class="btn btn-primary mt-3 rounded-pill">Kembali ke Berita</a></div>');
        }
    });
});
</script>

<?= view('templates/public/footer_public.php') ?>
