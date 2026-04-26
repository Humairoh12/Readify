<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* TABLE */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background: #f1f3f5;
    }

    .table-hover tbody tr:hover {
        background: #f9fbff;
    }

    /* BADGE */
    .badge {
        padding: 6px 10px;
        font-size: 12px;
    }

    /* BUTTON ICON */
    .btn i {
        font-size: 14px;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Users</h4>
        <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus"></i> Tambah User
        </a>
    </div>

    <!-- 🔹 FILTER -->
    <div class="glass-card p-3 mb-4">
        <form method="get" class="row g-2 align-items-center">

            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control"
                    placeholder="Cari nama..."
                    value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-md-3">
                <select name="role" class="form-select">
                    <option value="">Semua Role</option>
                    <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
                    <option value="petugas" <?= (($_GET['role'] ?? '') == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                    <option value="anggota" <?= (($_GET['role'] ?? '') == 'anggota') ? 'selected' : '' ?>>Anggota</option>
                </select>
            </div>

            <div class="col-md-5 d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
                <a href="<?= base_url('users') ?>" class="btn btn-secondary">Reset</a>
                <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank"
                    class="btn btn-success">
                    <i class="bi bi-printer"></i> Print
                </a>
            </div>

        </form>
    </div>

    <!-- 🔹 ALERT -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- 🔹 TABLE -->
    <div class="glass-card p-3">
        <div class="table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                        <?php if (session()->get('role') == 'admin') : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?= $no++ ?></td>

                                <td>
                                    <?php if ($u['foto']): ?>
                                        <img src="<?= base_url('uploads/users/' . $u['foto']) ?>"
                                            class="rounded-circle" width="50" height="50">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= $u['nama'] ?></td>
                                <td><?= $u['email'] ?></td>
                                <td><?= $u['username'] ?></td>

                                <td>
                                    <span class="badge bg-primary">
                                        <?= ucfirst($u['role']) ?>
                                    </span>
                                </td>

                                <?php if (session()->get('role') == 'admin') : ?>
                                    <td>
                                        <div class="d-flex gap-1">

                                            <a href="<?= base_url('users/detail/' . $u['id']) ?>"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="<?= base_url('users/edit/' . $u['id']) ?>"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <a href="<?= base_url('users/wa/' . $u['id']) ?>"
                                                target="_blank"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>

                                            <a href="<?= base_url('users/delete/' . $u['id']) ?>"
                                                onclick="return confirm('Hapus user ini?')"
                                                class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Belum ada data user
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

    <!-- 🔹 PAGINATION -->
    <div class="mt-3">
        <?= $pager->links() ?>
    </div>

</div>

<?= $this->endSection() ?>