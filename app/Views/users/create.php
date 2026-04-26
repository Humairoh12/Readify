<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        .dashboard-wrapper {
            padding: 20px;
        }

        .glass-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        }

        .page-header {
            padding: 18px 20px;
            border-radius: 15px;
            background: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
        }

        .btn {
            border-radius: 10px;
        }
    </style>
</head>

<body style="background:#f5f7fb;">

    <div class="container dashboard-wrapper">

        <!-- HEADER -->
        <div class="glass-card page-header mb-4">
            <h4 class="mb-0">Tambah User</h4>

            <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>

        <!-- ALERT -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <div class="glass-card p-4">

            <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    <!-- KIRI -->
                    <div class="col-md-6">

                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>

                        <label class="form-label mt-3">Email</label>
                        <input type="text" name="email" class="form-control" required>

                        <label class="form-label mt-3">Username</label>
                        <input type="text" name="username" class="form-control" required>

                    </div>

                    <!-- KANAN -->
                    <div class="col-md-6">

                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>

                        <label class="form-label mt-3">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="anggota">Anggota</option>
                        </select>

                        <label class="form-label mt-3">Foto Profil</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak upload</small>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        💾 Simpan
                    </button>

                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>

    </div>

</body>

</html>