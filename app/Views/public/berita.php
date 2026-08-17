<?= view('templates/public/header_public.php') ?>

<div class="container mt-4 mb-5 pb-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">Berita & <span class="text-primary">Artikel</span></h2>
            <p class="text-muted">Informasi terbaru seputar kampus dan tips menarik</p>
        </div>
    </div>

    <div class="row g-4" id="berita-container">
        <div class="col-12 text-center py-5">
            <p class="text-muted">Memuat berita...</p>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        url: base_url + 'api/berita',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(b) {
                    let img = base_url + 'assets/uploads/' + b.gambar;
                    let link = base_url + 'berita/' + b.slug;
                    let date = new Date(b.created_at);
                    let dateStr = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                    let konten = (b.konten || '').replace(/<[^>]*>/g, '').split(' ').slice(0, 20).join(' ');
                    html += '<div class="col-md-6 col-lg-4">';
                    html += '<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden article-card">';
                    html += '<img src="' + img + '" class="card-img-top object-fit-cover" height="220" alt="' + b.judul + '">';
                    html += '<div class="card-body p-4">';
                    html += '<div class="mb-2"><small class="text-muted"><i class="bi bi-calendar3 me-2"></i>' + dateStr + '</small></div>';
                    html += '<h5 class="card-title fw-bold"><a href="' + link + '" class="text-decoration-none text-body stretched-link">' + b.judul + '</a></h5>';
                    html += '<p class="card-text text-muted">' + konten + '</p>';
                    html += '</div></div></div>';
                });
                $('#berita-container').html(html);
            } else {
                $('#berita-container').html('<div class="col-12 text-center py-5"><p class="text-muted">Belum ada artikel berita yang dipublikasikan.</p></div>');
            }
        },
        error: function() {
            $('#berita-container').html('<div class="col-12 text-center py-5"><p class="text-muted">Gagal memuat berita.</p></div>');
        }
    });
});
</script>

<style>
.article-card { transition: transform 0.3s ease; }
.article-card:hover { transform: translateY(-5px); }
</style>

<?= view('templates/public/footer_public.php') ?>
