<?= view('templates/public/header_public.php') ?>

<div class="container mt-5 mb-5 pb-5">
    <div class="row mb-5 text-center">
        <div class="col-12">
            <h1 class="fw-bold">Hubungi <span class="text-primary">Kami</span></h1>
            <p class="text-muted">Ada pertanyaan, masukan, atau kendala? Jangan ragu untuk menghubungi kami.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i> <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi Kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Form Hubungi Kami -->
                <form action="<?= base_url('kontak') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="<?= old('nama') ?>" required placeholder="Masukkan nama">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Aktif <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required placeholder="Masukkan email">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Subjek Pesan <span class="text-danger">*</span></label>
                            <input type="text" name="subjek" class="form-control" value="<?= old('subjek') ?>" required placeholder="Contoh: Bantuan Akun">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Isi Pesan <span class="text-danger">*</span></label>
                            <textarea name="pesan" class="form-control" rows="5" required placeholder="Tuliskan pesan Anda secara detail..."><?= old('pesan') ?></textarea>
                        </div>
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">
                                <i class="bi bi-send me-1"></i> Kirim Pesan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="row mt-5 text-center">
                <div class="col-md-4 mb-3">
                    <i class="bi bi-geo-alt display-5 text-primary mb-2"></i>
                    <h6 class="fw-bold">Alamat</h6>
                    <p class="text-muted small">Kampus Ukrida, Jakarta Barat</p>
                </div>
                <div class="col-md-4 mb-3">
                    <i class="bi bi-envelope display-5 text-primary mb-2"></i>
                    <h6 class="fw-bold">Email</h6>
                    <p class="text-muted small">christian.412024003@civitas.ukrida.ac.id</p>
                </div>
                <div class="col-md-4 mb-3">
                    <i class="bi bi-whatsapp display-5 text-primary mb-2"></i>
                    <h6 class="fw-bold">WhatsApp</h6>
                    <p class="text-muted small">+62 896 8999 3392</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('templates/public/footer_public.php') ?>
