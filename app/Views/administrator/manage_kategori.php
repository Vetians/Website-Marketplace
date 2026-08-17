<?= view('templates/admin/header_admin') ?>
<?= view('templates/admin/sidebar_admin') ?>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header border-bottom p-3 p-lg-4 d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
        <h5 class="mb-0 fw-bold">Kelola Kategori Produk</h5>
        <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kategori-tbody">
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('administrator/kategori/simpan') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editKategoriModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editKategoriForm">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama" id="editKategoriNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="editKategoriDeskripsi" class="form-control" rows="3"></textarea>
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
    function loadKategori() {
        $.ajax({
            url: base_url + 'api/admin/kategori',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.status == 200 && res.data.length > 0) {
                    let html = '';
                    res.data.forEach(function(k, i) {
                        html += '<tr>';
                        html += '<td class="ps-4">' + (i + 1) + '</td>';
                        html += '<td class="fw-semibold">' + k.nama + '</td>';
                        html += '<td><code>' + k.slug + '</code></td>';
                        html += '<td>' + (k.deskripsi || '') + '</td>';
                        html += '<td class="pe-4 text-end">';
                        html += '<button class="btn btn-sm btn-outline-warning rounded-circle me-1" onclick="editKategori(' + k.id + ', \'' + k.nama.replace(/'/g, "\\'") + '\', \'' + (k.deskripsi || '').replace(/'/g, "\\'") + '\')" title="Edit"><i class="bi bi-pencil"></i></button>';
                        html += '<a href="' + base_url + 'administrator/kategori/hapus/' + k.id + '" class="btn btn-sm btn-outline-danger rounded-circle" onclick="return confirm(\'Yakin ingin menghapus kategori ini?\')" title="Hapus"><i class="bi bi-trash"></i></a>';
                        html += '</td></tr>';
                    });
                    $('#kategori-tbody').html(html);
                } else {
                    $('#kategori-tbody').html('<tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data kategori.</td></tr>');
                }
            },
            error: function() {
                $('#kategori-tbody').html('<tr><td colspan="5" class="text-center py-4 text-muted">Gagal memuat data.</td></tr>');
            }
        });
    }
    loadKategori();
});

function editKategori(id, nama, deskripsi) {
    $('#editKategoriNama').val(nama);
    $('#editKategoriDeskripsi').val(deskripsi);
    $('#editKategoriForm').attr('action', base_url + 'administrator/kategori/update/' + id);
    $('#editKategoriModal').modal('show');
}
</script>

<?= view('templates/admin/footer_admin') ?>
