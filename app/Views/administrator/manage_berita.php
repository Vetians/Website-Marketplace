<?= view('templates/admin/header_admin') ?>
<?= view('templates/admin/sidebar_admin') ?>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header border-bottom p-3 p-lg-4 d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
        <h5 class="mb-0 fw-bold">Daftar Berita & Artikel</h5>
        <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#tambahBeritaModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Berita
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Gambar</th>
                        <th>Judul Berita</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody id="berita-tbody">
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambahBeritaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('administrator/berita/simpan') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Berita Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea name="konten" class="form-control" rows="8" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Thumbnail</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editBeritaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" id="editBeritaForm">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" id="editBeritaJudul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="editBeritaStatus" class="form-select" required>
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea name="konten" id="editBeritaKonten" class="form-control" rows="8" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Thumbnail (Biarkan kosong jika tidak diganti)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <div class="mt-2" id="editBeritaGambarPreview"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        url: base_url + 'api/admin/berita',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(b, i) {
                    var img = base_url + 'assets/uploads/' + b.gambar;
                    var date = new Date(b.created_at);
                    var dateStr = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ', ' + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                    var badgeStatus = b.status == 'publish' ? 'bg-success' : 'bg-secondary';
                    var labelStatus = b.status == 'publish' ? 'Publish' : 'Draft';
                    html += '<tr>';
                    html += '<td class="ps-4">' + (i + 1) + '</td>';
                    html += '<td><img src="' + img + '" alt="Thumbnail" class="rounded" style="width: 80px; height: 50px; object-fit: cover;"></td>';
                    html += '<td class="fw-semibold">' + b.judul + '<br><small class="text-muted fw-normal">Slug: ' + b.slug + '</small></td>';
                    html += '<td><span class="badge ' + badgeStatus + '">' + labelStatus + '</span></td>';
                    html += '<td>' + dateStr + '</td>';
                    html += '<td class="pe-4 text-end">';
                    html += '<button class="btn btn-sm btn-outline-warning rounded-circle me-1" onclick="editBerita(' + b.id + ')" title="Edit"><i class="bi bi-pencil"></i></button>';
                    html += '<a href="' + base_url + 'administrator/berita/hapus/' + b.id + '" class="btn btn-sm btn-outline-danger rounded-circle" onclick="return confirm(\'Yakin ingin menghapus berita ini?\')" title="Hapus"><i class="bi bi-trash"></i></a>';
                    html += '</td></tr>';
                });
                $('#berita-tbody').html(html);
            } else {
                $('#berita-tbody').html('<tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data berita.</td></tr>');
            }
        },
        error: function() {
            $('#berita-tbody').html('<tr><td colspan="6" class="text-center py-4 text-muted">Gagal memuat data.</td></tr>');
        }
    });
});

function editBerita(id) {
    $.ajax({
        url: base_url + 'api/admin/berita/detail/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200) {
                var b = res.data;
                $('#editBeritaJudul').val(b.judul);
                $('#editBeritaStatus').val(b.status);
                $('#editBeritaKonten').val(b.konten);
                var imgHtml = '<img src="' + base_url + 'assets/uploads/' + b.gambar + '" width="150" class="rounded border">';
                $('#editBeritaGambarPreview').html(imgHtml);
                $('#editBeritaForm').attr('action', base_url + 'administrator/berita/update/' + b.id);
                $('#editBeritaModal').modal('show');
            }
        },
        error: function() {
            alert('Gagal memuat data berita.');
        }
    });
}
</script>

<?= view('templates/admin/footer_admin') ?>
