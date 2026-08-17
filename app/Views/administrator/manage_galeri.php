<?= view('templates/admin/header_admin') ?>
<?= view('templates/admin/sidebar_admin') ?>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header border-bottom p-3 p-lg-4 d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
        <h5 class="mb-0 fw-bold">Kelola Galeri Foto</h5>
        <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#tambahGaleriModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Foto
        </button>
    </div>
    <div class="card-body p-4">
        <div class="row g-4" id="galeri-row">
            <div class="col-12 text-center py-5 text-muted">
                Memuat data...
            </div>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambahGaleriModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('administrator/galeri/simpan') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Foto Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Foto</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Foto</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        url: base_url + 'api/admin/galeri',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(g) {
                    var img = base_url + 'assets/uploads/' + g.gambar;
                    var date = new Date(g.created_at);
                    var dateStr = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                    html += '<div class="col-sm-6 col-lg-3">';
                    html += '<div class="card h-100 border shadow-sm">';
                    html += '<img src="' + img + '" class="card-img-top object-fit-cover" height="200" alt="' + g.judul + '">';
                    html += '<div class="card-body">';
                    html += '<h6 class="card-title fw-bold text-truncate" title="' + g.judul + '">' + g.judul + '</h6>';
                    html += '<p class="card-text small text-muted text-truncate">' + (g.deskripsi || '') + '</p>';
                    html += '<div class="d-flex justify-content-between align-items-center mt-3">';
                    html += '<small class="text-muted">' + dateStr + '</small>';
                    html += '<a href="' + base_url + 'administrator/galeri/hapus/' + g.id + '" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Yakin ingin menghapus foto ini?\')"><i class="bi bi-trash"></i> Hapus</a>';
                    html += '</div></div></div></div>';
                });
                $('#galeri-row').html(html);
            } else {
                $('#galeri-row').html('<div class="col-12 text-center py-5 text-muted"><i class="bi bi-image display-1 mb-3 opacity-25"></i><p>Belum ada foto di galeri.</p></div>');
            }
        },
        error: function() {
            $('#galeri-row').html('<div class="col-12 text-center py-5 text-muted"><p>Gagal memuat data.</p></div>');
        }
    });
});
</script>
<?= view('templates/admin/footer_admin') ?>
