<?= view('templates/admin/header_admin') ?>
<?= view('templates/admin/sidebar_admin') ?>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header border-bottom p-3 p-lg-4 d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
        <h5 class="mb-0 fw-bold">Pesan Masuk</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Tanggal</th>
                        <th>Pengirim</th>
                        <th>Subjek</th>
                        <th>Isi Pesan</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pesan-tbody">
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Baca Pesan Modal -->
<div class="modal fade" id="bacaPesanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Detail Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3 border-bottom pb-3">
                    <div class="row">
                        <div class="col-4 text-muted">Dari</div>
                        <div class="col-8 fw-semibold text-break" id="pesanDari"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-muted">Subjek</div>
                        <div class="col-8 fw-semibold text-break" id="pesanSubjek"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-muted">Tanggal</div>
                        <div class="col-8" id="pesanTanggal"></div>
                    </div>
                </div>
                <div>
                    <p class="text-muted mb-1">Isi Pesan:</p>
                    <div class="p-3 rounded text-break" id="pesanIsi"></div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="pesanReplyLink" class="btn btn-primary"><i class="bi bi-reply"></i> Balas Email</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        url: base_url + 'api/admin/pesan',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(p, i) {
                    let date = new Date(p.created_at);
                    let dateStr = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ', ' + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                    let pesanPreview = p.pesan.length > 80 ? p.pesan.substring(0, 80) + '...' : p.pesan;
                    html += '<tr>';
                    html += '<td class="ps-4">' + (i + 1) + '</td>';
                    html += '<td class="text-nowrap">' + dateStr + '</td>';
                    html += '<td><strong>' + p.nama + '</strong><br><small class="text-muted"><a href="mailto:' + p.email + '">' + p.email + '</a></small></td>';
                    html += '<td class="fw-semibold text-truncate" style="max-width: 200px;">' + p.subjek + '</td>';
                    html += '<td><button type="button" class="btn btn-sm btn-light" onclick="bacaPesan(' + i + ')">Baca Pesan</button></td>';
                    html += '<td class="pe-4 text-end"><a href="' + base_url + 'administrator/pesan/hapus/' + p.id + '" class="btn btn-sm btn-outline-danger rounded-circle" onclick="return confirm(\'Yakin ingin menghapus pesan ini?\')" title="Hapus"><i class="bi bi-trash"></i></a></td></tr>';
                });
                window.pesanData = res.data;
                $('#pesan-tbody').html(html);
            } else {
                $('#pesan-tbody').html('<tr><td colspan="6" class="text-center py-4 text-muted">Belum ada pesan masuk.</td></tr>');
            }
        },
        error: function() {
            $('#pesan-tbody').html('<tr><td colspan="6" class="text-center py-4 text-muted">Gagal memuat data.</td></tr>');
        }
    });
});

function bacaPesan(idx) {
    var p = window.pesanData[idx];
    $('#pesanDari').text(p.nama + ' (' + p.email + ')');
    $('#pesanSubjek').text(p.subjek);
    $('#pesanTanggal').text(new Date(p.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' }));
    $('#pesanIsi').html(p.pesan.replace(/\n/g, '<br>'));
    $('#pesanReplyLink').attr('href', 'mailto:' + p.email + '?subject=RE: ' + encodeURIComponent(p.subjek));
    $('#bacaPesanModal').modal('show');
}
</script>

<?= view('templates/admin/footer_admin') ?>
