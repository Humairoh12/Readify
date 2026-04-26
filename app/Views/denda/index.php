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
        padding: 5px 8px;
        border-radius: 8px;
    }

    form .form-control {
        border-radius: 10px;
    }

    form .form-select {
        border-radius: 10px;
    }
</style>

<div class="card-custom">
    <h3 class="title">💰 Data Denda</h3>

    <!-- FORM -->
    <form method="get" class="mb-3 d-flex gap-2 flex-wrap">
        <input type="text" name="keyword" class="form-control"
            placeholder="Cari data denda..."
            value="<?= esc($keyword ?? '') ?>">

        <button class="btn btn-primary btn-custom">🔍</button>

        <a href="<?= base_url('denda') ?>" class="btn btn-secondary btn-custom">Reset</a>

        <a href="<?= base_url('denda/print?' . http_build_query($_GET)) ?>" target="_blank"
            class="btn btn-success btn-custom">🖨️</a>
    </form>

    <!-- TABLE -->
    <table class="table table-bordered table-custom">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Peminjaman</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Metode</th>
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

                        <!-- JUMLAH -->
                        <td>
                            <?php if (!empty($d['jumlah_denda']) && $d['jumlah_denda'] > 0): ?>
                                <span class="text-danger fw-bold">
                                    Rp <?= number_format($d['jumlah_denda'], 0, ',', '.') ?>
                                </span>
                            <?php else: ?>
                                -
                            <?php endif; ?>
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
                            <?= !empty($d['metode_pembayaran'])
                                ? '<span class="text-uppercase">' . esc($d['metode_pembayaran']) . '</span>'
                                : '<span class="text-muted">-</span>' ?>
                        </td>

                        <!-- AKSI -->
                        <td>

                            <?php if ($status == 'belum bayar' && $role == 'anggota'): ?>

                                <form action="<?= base_url('denda/bayar/' . $d['id_denda']) ?>"
                                    method="post"
                                    enctype="multipart/form-data"
                                    class="d-flex gap-2 flex-wrap">

                                    <select name="metode_pembayaran"
                                        id="metode-<?= $d['id_denda'] ?>"
                                        class="form-select form-select-sm"
                                        onchange="toggleBukti(<?= $d['id_denda'] ?>)">

                                        <option value="cash">Cash</option>
                                    </select>

                                    <div id="bukti-box-<?= $d['id_denda'] ?>" style="display:none;">
                                        <input type="file" name="bukti_pembayaran" class="form-control form-control-sm">
                                    </div>

                                    <button class="btn btn-success btn-sm">
                                        💳
                                    </button>
                                </form>

                            <?php elseif ($status == 'menunggu verifikasi'): ?>

                                <?php if (in_array($role, ['admin', 'petugas'])): ?>
                                    <a href="<?= base_url('denda/verifikasi/' . $d['id_denda']) ?>"
                                        class="btn btn-success btn-sm" title="Verifikasi">
                                        ✔
                                    </a>
                                <?php else: ?>
                                    <span class="text-warning">⏳</span>
                                <?php endif; ?>

                            <?php elseif ($status == 'lunas'): ?>

                                <span class="text-success">✔</span>

                                <?php if ($role == 'admin'): ?>
                                    <form action="<?= base_url('denda/hapus/' . $d['id_denda']) ?>"
                                        method="post"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin hapus data ini?')">

                                        <button class="btn btn-danger btn-sm">🗑️</button>
                                    </form>
                                <?php endif; ?>

                            <?php elseif ($status == 'ditolak'): ?>

                                <?php if ($role == 'anggota'): ?>
                                    <a href="<?= base_url('denda/bayar/' . $d['id_denda']) ?>"
                                        class="btn btn-warning btn-sm">
                                        🔁
                                    </a>
                                <?php else: ?>
                                    <span class="text-danger">✖</span>
                                <?php endif; ?>

                            <?php endif; ?>

                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data denda
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    function toggleBukti(id) {
        let metode = document.getElementById('metode-' + id);
        let box = document.getElementById('bukti-box-' + id);

        if (metode.value === 'qris') {
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    }
</script>

<?= $this->endSection() ?>