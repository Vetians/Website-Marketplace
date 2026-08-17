<?= view('templates/public/header_public.php') ?>

<div class="container mt-4 mb-5 pb-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">Galeri <span class="text-primary">Foto</span></h2>
            <p class="text-muted">Koleksi foto kegiatan dan dokumentasi kampus</p>
        </div>
    </div>

    <div class="row g-4" id="galeri-container">
        <div class="col-12 text-center py-5">
            <p class="text-muted">Memuat galeri...</p>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        url: base_url + 'api/galeri',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(g, i) {
                    let img = base_url + 'assets/uploads/' + g.gambar;
                    let modalId = 'galleryModal' + i;
                    html += '<div class="col-md-4 col-lg-3">';
                    html += '<div class="card border-0 shadow-sm rounded-4 overflow-hidden gallery-card" data-bs-toggle="modal" data-bs-target="#' + modalId + '">';
                    html += '<img src="' + img + '" class="card-img-top object-fit-cover" height="250" alt="' + g.judul + '" style="cursor: pointer;">';
                    html += '<div class="card-body text-center py-2"><p class="mb-0 fw-semibold text-truncate small">' + g.judul + '</p></div>';
                    html += '</div></div>';
                    html += '<div class="modal fade" id="' + modalId + '" tabindex="-1" aria-hidden="true">';
                    html += '<div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content bg-transparent border-0">';
                    html += '<div class="modal-header border-0 pb-0"><button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button></div>';
                    html += '<div class="modal-body text-center pt-0">';
                    html += '<img src="' + img + '" class="img-fluid rounded-3" alt="' + g.judul + '">';
                    html += '<div class="bg-dark bg-opacity-75 text-white p-3 rounded-3 mt-3">';
                    html += '<h5 class="mb-1 fw-bold">' + g.judul + '</h5>';
                    html += '<p class="mb-0">' + (g.deskripsi || '') + '</p></div></div></div></div></div>';
                });
                $('#galeri-container').html(html);
            } else {
                $('#galeri-container').html('<div class="col-12 text-center py-5"><p class="text-muted">Belum ada foto yang diunggah ke galeri.</p></div>');
            }
        },
        error: function() {
            $('#galeri-container').html('<div class="col-12 text-center py-5"><p class="text-muted">Gagal memuat galeri.</p></div>');
        }
    });
});
</script>

<style>
.gallery-card { transition: transform 0.3s ease; }
.gallery-card:hover { transform: scale(1.03); }
</style>

<?= view('templates/public/footer_public.php') ?>
