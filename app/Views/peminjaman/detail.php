<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* DETAIL TABLE */
    .detail-table th {
        width: 180px;
        font-weight: 600;
        color: #555;
    }

    .detail-table td {
        color: #333;
    }

    .detail-table tr {
        border-bottom: 1px solid #eee;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Detail Peminjaman</h4>

        <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- 🔹 CONTENT -->
    <div class="glass-card p-4">

        <table class="table table-borderless detail-table">

            <tr>
                <th>Anggota</th>
                <td><?= $peminjaman['nama_anggota'] ?></td>
            </tr>

            <tr>
                <th>Petugas</th>
                <td><?= $peminjaman['nama_petugas'] ?></td>
            </tr>

            <tr>
                <th>Tanggal Pinjam</th>
                <td><?= $peminjaman['tanggal_pinjam'] ?></td>
            </tr>

            <tr>
                <th>Jatuh Tempo</th>
                <td><?= $peminjaman['tanggal_kembali'] ?? '-' ?></td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    <?php if ($peminjaman['status'] == 'dipinjam'): ?>
                        <span class="badge bg-primary">Dipinjam</span>
                    <?php elseif ($peminjaman['status'] == 'terlambat'): ?>
                        <span class="badge bg-danger">Terlambat</span>
                    <?php else: ?>
                        <span class="badge bg-success">Kembali</span>
                    <?php endif; ?>
                </td>
            </tr>

        </table>

    </div>

</div>

<?= $this->endSection() ?>