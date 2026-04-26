<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* DETAIL IMAGE */
    .detail-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
    }

    /* DETAIL TABLE */
    .detail-table th {
        width: 150px;
        font-weight: 600;
        color: #555;
    }

    .detail-table td {
        color: #333;
    }

    /* TABLE SPACING */
    .detail-table tr {
        border-bottom: 1px solid #eee;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Detail User</h4>

        <div class="d-flex gap-2">
            <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <?php if (session()->get('role') == 'admin') : ?>
                <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- 🔹 CONTENT -->
    <div class="glass-card p-4">

        <div class="row align-items-center">

            <!-- FOTO -->
            <div class="col-md-4 text-center mb-3">
                <?php if ($user['foto']): ?>
                    <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                        class="detail-img shadow-sm">
                <?php else: ?>
                    <div class="text-muted">Tidak ada foto</div>
                <?php endif; ?>
            </div>

            <!-- DATA -->
            <div class="col-md-8">

                <table class="table table-borderless detail-table">
                    <tr>
                        <th>Nama</th>
                        <td><?= $user['nama'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $user['email'] ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?= $user['username'] ?></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>••••••••</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>
                            <span class="badge bg-primary">
                                <?= ucfirst($user['role']) ?>
                            </span>
                        </td>
                    </tr>
                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>