<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* FORM */
    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px;
    }

    /* LABEL */
    .form-label {
        font-weight: 500;
    }

    /* PREVIEW IMAGE */
    .preview-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
    }

    /* BUTTON */
    .btn {
        border-radius: 10px;
    }

    /* INPUT FOCUS */
    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.3);
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Edit User</h4>
        <a href="<?= base_url('users') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- 🔹 FORM -->
    <div class="glass-card p-4">

        <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">

            <div class="row">

                <!-- LEFT -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control"
                            value="<?= $user['nama'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control"
                            value="<?= $user['email'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control"
                            value="<?= $user['username'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak diubah</small>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                            <option value="anggota" <?= $user['role'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <div class="mb-3 text-center">
                        <p class="mb-2">Foto Sekarang</p>

                        <?php if ($user['foto']): ?>
                            <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                                class="rounded-circle shadow-sm preview-img">
                        <?php else: ?>
                            <div class="text-muted">Tidak ada foto</div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>

                <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>