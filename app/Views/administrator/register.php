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
        .register-card { max-width: 450px; margin: 60px auto; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card register-card border-0 p-4">
            <div class="text-center mb-4">
                <img src="<?= base_url('assets/images/logo_hitam.png') ?>" alt="Logo" height="60">
                <h4 class="fw-bold mt-3">Register Admin</h4>
                <p class="text-muted">Daftar untuk mengakses panel administrator</p>
            </div>
            
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 px-3">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= old('nama') ?>" required placeholder="John Doe">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required placeholder="admin@ukrida.ac.id">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Min. 6 karakter">
                </div>
                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_verify" class="form-control" required placeholder="Ulangi password">
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-semibold">Daftar Sekarang</button>
            </form>
            
            <div class="text-center mt-4">
                <p class="mb-0 text-muted">Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-decoration-none fw-bold">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
