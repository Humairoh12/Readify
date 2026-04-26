<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* TABLE GLOBAL */
    .table th {
        font-weight: 600;
        color: #555;
    }

    .table td {
        vertical-align: middle;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Pengembalian</h4>

        <a href="<?= base_url('pengembalian/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Pengembalian
        </a>
    </div>

    <!-- 🔹 FILTER -->
    <div class="glass-card p-3 mb-4">
        <form method="get" class="row g-2">

            <div class="col-md-6">
                <input type="text" name="keyword"
                    class="form-control"
                    placeholder="Cari data..."
                    value="<?= esc($keyword ?? '') ?>">
            </div>

            <div class="col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>

                <a href="<?= base_url('pengembalian') ?>" class="btn btn-secondary">
                    Reset
                </a>

                <a href="<?= base_url('pengembalian/print?' . http_build_query($_GET)) ?>"
                    target="_blank"
                    class="btn btn-success">
                    <i class="bi bi-printer"></i> Print
                </a>
            </div>

        </form>
    </div>

    <!-- 🔹 TABLE -->
    <div class="glass-card p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>ID Peminjaman</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($pengembalian)): ?>
                        <?php $no = 1;
                        foreach ($pengembalian as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>#<?= $p['id_peminjaman'] ?></td>
                                <td><?= $p['tanggal_dikembalikan'] ?></td>

                                <td class="<?= $p['denda'] > 0 ? 'text-danger' : 'text-success' ?>">
                                    Rp <?= number_format($p['denda'], 0, ',', '.') ?>
                                </td>

                                <td>
                                    <a href="<?= base_url('pengembalian/delete/' . $p['id_pengembalian']) ?>"
                                        onclick="return confirm('Hapus?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada data pengembalian
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>