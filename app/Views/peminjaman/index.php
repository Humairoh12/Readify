<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* TABLE */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    /* AKSI BUTTON WRAP */
    td .btn-sm {
        border-radius: 6px;
        padding: 4px 6px;
    }

    /* BADGE */
    .badge {
        font-size: 11px;
        padding: 6px 8px;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">📚 Data Peminjaman</h4>

        <?php if (session()->get('role') == 'anggota') : ?>
            <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <!-- 🔹 FILTER -->
    <div class="glass-card p-3 mb-4">
        <form method="get" class="row g-2">

            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control"
                    placeholder="Cari peminjaman..."
                    value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-md-6 d-flex gap-2">
                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>

                <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
                    Reset
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
                        <th>Anggota</th>
                        <th>Petugas</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1;
                    foreach ($peminjaman as $p): ?>
                        <?php $denda = $p['denda'] ?? 0; ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $p['nama_anggota'] ?></td>
                            <td><?= $p['nama_petugas'] ?></td>
                            <td><?= $p['judul'] ?></td>
                            <td><?= $p['tanggal_pinjam'] ?></td>
                            <td><?= $p['tanggal_kembali'] ?></td>

                            <!-- STATUS -->
                            <td>
                                <?php if ($p['status'] == 'dipinjam'): ?>
                                    <span class="badge bg-primary">Dipinjam</span>
                                <?php elseif ($p['status'] == 'terlambat'): ?>
                                    <span class="badge bg-danger">Terlambat</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Kembali</span>
                                <?php endif; ?>
                            </td>

                            <!-- DENDA -->
                            <td>
                                <span class="badge <?= $denda > 0 ? 'bg-danger' : 'bg-success' ?>">
                                    Rp <?= number_format($denda, 0, ',', '.') ?>
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td class="d-flex flex-wrap gap-1">

                                <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>"
                                    class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="<?= base_url('peminjaman/perpanjang/' . $p['id_peminjaman']) ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="bi bi-arrow-repeat"></i>
                                </a>

                                <?php if (in_array(session()->get('role'), ['admin', 'petugas'])): ?>
                                    <a href="<?= base_url('peminjaman/kembalikan/' . $p['id_peminjaman']) ?>"
                                        class="btn btn-success btn-sm">
                                        <i class="bi bi-check-circle"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="<?= base_url('peminjaman/kirimWA/' . $p['id_peminjaman']) ?>"
                                    target="_blank"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-whatsapp"></i>
                                </a>

                                <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
                                    onclick="return confirm('Hapus?')"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </td>
                        </tr>

                        <!-- 💳 STATUS BAYAR -->
                        <?php if ($denda > 0): ?>
                            <tr>
                                <td colspan="9">
                                    <?php if ($p['status_bayar'] == 'belum'): ?>
                                        <span class="text-danger">
                                            💰 Belum bayar — silakan ke menu denda
                                        </span>
                                    <?php else: ?>
                                        <span class="text-success">
                                            ✔ Sudah lunas
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>