<?= view('templates/admin/header_admin') ?>
<?= view('templates/admin/sidebar_admin') ?>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header border-bottom p-3 p-lg-4 d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
        <h5 class="mb-0 fw-bold">Daftar Produk Preloved</h5>
        <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody id="produk-tbody">
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambahProdukModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('administrator/produk/simpan') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" id="tambahProdukKategori" class="form-select" required>
                                <option value="">Pilih Kategori...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kondisi</label>
                            <select name="kondisi" class="form-select" required>
                                <option value="bekas">Bekas</option>
                                <option value="baru">Baru</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Gambar Produk</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal (shared) -->
<div class="modal fade" id="editProdukModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" id="editProdukForm">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" id="editProdukNama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" id="editProdukKategori" class="form-select" required></select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" id="editProdukHarga" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" id="editProdukStok" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kondisi</label>
                            <select name="kondisi" id="editProdukKondisi" class="form-select" required>
                                <option value="baru">Baru</option>
                                <option value="bekas">Bekas</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" id="editProdukStatus" class="form-select" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="editProdukDeskripsi" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Gambar (Biarkan kosong jika tidak diganti)</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                            <div class="mt-2" id="editProdukGambarPreview"></div>
                        </div>
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
var kategoriOptions = [];
$(document).ready(function() {
    // Load kategori once
    $.ajax({
        url: base_url + 'api/admin/kategori',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200) {
                kategoriOptions = res.data;
                var opts = '<option value="">Pilih Kategori...</option>';
                res.data.forEach(function(k) {
                    opts += '<option value="' + k.id + '">' + k.nama + '</option>';
                });
                $('#tambahProdukKategori').html(opts);
                $('#editProdukKategori').html(opts);
            }
        }
    });

    // Load produk list
    loadProduk();
});

function loadProduk() {
    $.ajax({
        url: base_url + 'api/admin/produk',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(p, i) {
                    var img = base_url + 'assets/uploads/' + p.gambar;
                    var harga = 'Rp ' + new Intl.NumberFormat('id-ID').format(p.harga);
                    var badgeStatus = p.status == 'aktif' ? 'bg-success' : 'bg-danger';
                    var labelStatus = p.status == 'aktif' ? 'Aktif' : 'Nonaktif';
                    html += '<tr>';
                    html += '<td class="ps-4">' + (i + 1) + '</td>';
                    html += '<td><img src="' + img + '" alt="' + p.nama + '" class="rounded" style="width: 60px; height: 60px; object-fit: cover;"></td>';
                    html += '<td class="fw-semibold">' + p.nama + '</td>';
                    html += '<td><span class="badge bg-secondary">' + (p.nama_kategori || '') + '</span></td>';
                    html += '<td>' + harga + '</td>';
                    html += '<td>' + p.stok + '</td>';
                    html += '<td>' + p.kondisi.charAt(0).toUpperCase() + p.kondisi.slice(1) + '</td>';
                    html += '<td><span class="badge ' + badgeStatus + '">' + labelStatus + '</span></td>';
                    html += '<td class="pe-4 text-end">';
                    html += '<button class="btn btn-sm btn-outline-warning rounded-circle me-1" onclick="editProduk(' + p.id + ')" title="Edit"><i class="bi bi-pencil"></i></button>';
                    html += '<a href="' + base_url + 'administrator/produk/hapus/' + p.id + '" class="btn btn-sm btn-outline-danger rounded-circle" onclick="return confirm(\'Yakin ingin menghapus produk ini?\')" title="Hapus"><i class="bi bi-trash"></i></a>';
                    html += '</td></tr>';
                });
                $('#produk-tbody').html(html);
            } else {
                $('#produk-tbody').html('<tr><td colspan="9" class="text-center py-4 text-muted">Belum ada data produk.</td></tr>');
            }
        },
        error: function() {
            $('#produk-tbody').html('<tr><td colspan="9" class="text-center py-4 text-muted">Gagal memuat data.</td></tr>');
        }
    });
}

function editProduk(id) {
    $.ajax({
        url: base_url + 'api/admin/produk/detail/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200) {
                var p = res.data;
                $('#editProdukNama').val(p.nama);
                $('#editProdukKategori').val(p.kategori_id);
                $('#editProdukHarga').val(p.harga);
                $('#editProdukStok').val(p.stok);
                $('#editProdukKondisi').val(p.kondisi);
                $('#editProdukStatus').val(p.status);
                $('#editProdukDeskripsi').val(p.deskripsi);
                var imgHtml = '<img src="' + base_url + 'assets/uploads/' + p.gambar + '" width="100" class="rounded border">';
                $('#editProdukGambarPreview').html(imgHtml);
                $('#editProdukForm').attr('action', base_url + 'administrator/produk/update/' + p.id);
                $('#editProdukModal').modal('show');
            }
        },
        error: function() {
            alert('Gagal memuat data produk.');
        }
    });
}
</script>

<?= view('templates/admin/footer_admin') ?>
