<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .login-card { max-width: 400px; margin: 100px auto; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card login-card border-0 p-4">
            <div class="text-center mb-4">
                <img src="<?= base_url('assets/images/logo_hitam.png') ?>" alt="Logo" height="60">
                <h4 class="fw-bold mt-3">Admin Login</h4>
                <p class="text-muted">Masuk untuk mengelola Preloved Ukrida</p>
            </div>
            
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger py-2"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success py-2"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="admin@ukrida.ac.id">
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="********">
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-semibold">Login</button>
            </form>
            
            <div class="text-center mt-4">
                <p class="mb-0 text-muted">Belum punya akun? <a href="<?= base_url('register') ?>" class="text-decoration-none fw-bold">Daftar</a></p>
                <a href="<?= base_url() ?>" class="text-decoration-none mt-2 d-inline-block text-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
