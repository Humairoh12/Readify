<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .card-custom {
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .title {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .table-custom th {
        background: #f8f9fa;
        text-align: center;
    }

    .table-custom td {
        vertical-align: middle;
    }

    .btn-custom {
        border-radius: 10px;
    }

    .btn-sm {
        border-radius: 8px;
        padding: 5px 8px;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
    }
</style>

<div class="card-custom">
    <h3 class="title">💳 Bayar Denda</h3>

    <!-- SEARCH -->
    <form method="get" class="mb-3 d-flex gap-2 flex-wrap">
        <input type="text" name="search" class="form-control"
            placeholder="Cari nama / ID..."
            value="<?= esc($search ?? '') ?>">

        <button class="btn btn-primary btn-custom">🔍</button>
    </form>

    <!-- TABLE -->
    <table class="table table-bordered table-custom">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Peminjaman</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Metode</th>
                <th>Bukti</th>
                <th>Petugas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($denda)) : ?>
                <?php foreach ($denda as $d): ?>

                    <?php
                    $status = $d['status_denda'] ?? 'belum bayar';
                    $role = session()->get('role');
                    ?>

                    <tr>
                        <td><?= $d['id_denda'] ?></td>
                        <td><?= $d['id_peminjaman'] ?? '-' ?></td>
                        <td><?= $d['nama_anggota'] ?? '-' ?></td>

                        <!-- JUMLAH -->
                        <td>
                            <?= !empty($d['jumlah_denda'])
                                ? '<span class="text-danger fw-bold">Rp ' . number_format($d['jumlah_denda'], 0, ',', '.') . '</span>'
                                : '-' ?>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <?php if ($status == 'belum bayar'): ?>
                                <span class="badge bg-danger">Belum</span>
                            <?php elseif ($status == 'menunggu verifikasi'): ?>
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            <?php elseif ($status == 'lunas'): ?>
                                <span class="badge bg-success">Lunas</span>
                            <?php elseif ($status == 'ditolak'): ?>
                                <span class="badge bg-danger">Ditolak</span>
                            <?php endif; ?>
                        </td>

                        <!-- METODE -->
                        <td>
                            <?= $d['metode_pembayaran']
                                ? '<span class="text-uppercase">' . esc($d['metode_pembayaran']) . '</span>'
                                : '<span class="text-muted">-</span>' ?>
                        </td>

                        <!-- BUKTI -->
                        <td>
                            <?php if (!empty($d['bukti_pembayaran'])): ?>
                                <a href="<?= base_url('uploads/' . $d['bukti_pembayaran']) ?>"
                                    target="_blank"
                                    class="btn btn-info btn-sm">
                                    👁️
                                </a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>

                        <!-- PETUGAS -->
                        <td><?= $d['nama_petugas_verif'] ?? '-' ?></td>

                        <!-- AKSI -->
                        <td>

                            <?php if ($status == 'belum bayar' && $role == 'anggota'): ?>

                                <form action="<?= base_url('denda/bayar/' . $d['id_denda']) ?>"
                                    method="post"
                                    enctype="multipart/form-data"
                                    class="d-flex flex-column gap-1">

                                    <select name="metode_pembayaran" class="form-select form-select-sm" required>
                                        <option value="">Metode</option>
                                        <option value="cash">Cash</option>
                                        <option value="qris">QRIS</option>
                                    </select>

                                    <input type="file" name="bukti_pembayaran"
                                        class="form-control form-control-sm" required>

                                    <button class="btn btn-success btn-sm">
                                        💳
                                    </button>
                                </form>

                            <?php elseif ($status == 'menunggu verifikasi'): ?>
                                <span class="text-warning">⏳</span>

                            <?php elseif ($status == 'lunas'): ?>
                                <span class="text-success">✔</span>

                            <?php elseif ($status == 'ditolak' && $role == 'anggota'): ?>
                                <a href="<?= base_url('denda/bayar/' . $d['id_denda']) ?>"
                                    class="btn btn-warning btn-sm">
                                    🔁
                                </a>
                            <?php endif; ?>

                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">
                        Tidak ada data denda
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>