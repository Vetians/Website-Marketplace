<?= view('templates/admin/header_admin') ?>
<?= view('templates/admin/sidebar_admin') ?>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header border-bottom p-3 p-lg-4 d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
        <h5 class="mb-0 fw-bold">Kelola User</h5>
        <a href="<?= base_url('register') ?>" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-person-plus me-1"></i> Tambah User
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Tanggal Terdaftar</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody id="user-tbody">
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
const currentUserId = <?= session()->get('id') ?>;
$(document).ready(function() {
    $.ajax({
        url: base_url + 'api/admin/user',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200 && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(u, i) {
                    let avatar = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(u.nama) + '&background=random';
                    let date = new Date(u.created_at);
                    let dateStr = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ', ' + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                    html += '<tr>';
                    html += '<td class="ps-4">' + (i + 1) + '</td>';
                    html += '<td><div class="d-flex align-items-center">';
                    html += '<img src="' + avatar + '" class="rounded-circle me-3" width="40" height="40">';
                    html += '<div><div class="fw-semibold">' + u.nama + '</div><div class="small text-muted">' + (u.email || '') + '</div></div>';
                    html += '</div></td>';
                    html += '<td><span class="badge bg-primary text-uppercase">' + u.role + '</span></td>';
                    html += '<td>' + dateStr + '</td>';
                    html += '<td class="pe-4 text-end">';
                    if (u.id != currentUserId) {
                        html += '<a href="' + base_url + 'administrator/user/hapus/' + u.id + '" class="btn btn-sm btn-outline-danger rounded-circle" onclick="return confirm(\'Yakin ingin menghapus user ini?\')" title="Hapus"><i class="bi bi-trash"></i></a>';
                    } else {
                        html += '<button class="btn btn-sm btn-secondary rounded-circle" disabled title="Anda Sendiri"><i class="bi bi-person-badge"></i></button>';
                    }
                    html += '</td></tr>';
                });
                $('#user-tbody').html(html);
            } else {
                $('#user-tbody').html('<tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data user.</td></tr>');
            }
        },
        error: function() {
            $('#user-tbody').html('<tr><td colspan="5" class="text-center py-4 text-muted">Gagal memuat data.</td></tr>');
        }
    });
});
</script>

<?= view('templates/admin/footer_admin') ?>
