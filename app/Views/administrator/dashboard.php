<?= view('templates/admin/header_admin') ?>
<?= view('templates/admin/sidebar_admin') ?>

<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm text-center py-4 bg-primary text-white rounded-4">
            <i class="bi bi-box-seam display-4 mb-2"></i>
            <h3 class="fw-bold mb-0" id="stat-produk">-</h3>
            <span class="text-uppercase small fw-semibold opacity-75">Total Produk</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm text-center py-4 bg-success text-white rounded-4">
            <i class="bi bi-newspaper display-4 mb-2"></i>
            <h3 class="fw-bold mb-0" id="stat-berita">-</h3>
            <span class="text-uppercase small fw-semibold opacity-75">Berita & Artikel</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm text-center py-4 bg-warning text-white rounded-4">
            <i class="bi bi-envelope display-4 mb-2"></i>
            <h3 class="fw-bold mb-0" id="stat-pesan">-</h3>
            <span class="text-uppercase small fw-semibold opacity-75">Pesan Masuk</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm text-center py-4 bg-info text-white rounded-4">
            <i class="bi bi-people display-4 mb-2"></i>
            <h3 class="fw-bold mb-0" id="stat-user">-</h3>
            <span class="text-uppercase small fw-semibold opacity-75">Total User</span>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3">Selamat Datang, <?= esc(session()->get('nama')) ?>!</h5>
        <p class="text-muted mb-0">Anda berada di panel administrator Preloved Ukrida. Panel Admin disini dibuat untuk mengelola konten website seperti produk marketplace, artikel berita, galeri foto, kategori, dan melihat pesan masuk dari pengguna website yang mengirimkan pesan.</p>
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        url: base_url + 'api/admin/dashboard',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status == 200) {
                $('#stat-produk').text(res.data.total_produk || 0);
                $('#stat-berita').text(res.data.total_berita || 0);
                $('#stat-pesan').text(res.data.total_pesan || 0);
                $('#stat-user').text(res.data.total_user || 0);
            }
        }
    });
});
</script>
<?= view('templates/admin/footer_admin') ?>
