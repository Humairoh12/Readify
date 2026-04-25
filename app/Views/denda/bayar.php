<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Bayar Denda</h2>

<form method="get">
    <input type="text" name="search" placeholder="Cari nama / ID..."
        value="<?= esc($search ?? '') ?>">
    <button type="submit">Search</button>
</form>

<br>

<table border="1" cellpadding="8" width="100%">

    <tr>
        <th>ID</th>
        <th>ID Peminjaman</th>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Metode</th>
        <th>Bukti</th>
        <th>Petugas Verifikasi</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($denda)) : ?>
        <?php foreach ($denda as $d): ?>

            <?php
            $status = $d['status_denda'] ?? 'belum bayar';
            $role = session()->get('role');
            ?>

            <tr>

                <!-- ID -->
                <td><?= $d['id_denda'] ?></td>

                <!-- PEMINJAMAN -->
                <td><?= $d['id_peminjaman'] ?? '-' ?></td>

                <!-- NAMA -->
                <td><?= $d['nama_anggota'] ?? '-' ?></td>

                <!-- JUMLAH -->
                <td>
                    <?php if (!empty($d['jumlah_denda'])): ?>
                        <span style="color:red;">
                            Rp <?= number_format($d['jumlah_denda'], 0, ',', '.') ?>
                        </span>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                <!-- STATUS -->
                <td>
                    <?php if ($status == 'belum bayar'): ?>
                        <span style="color:red;">Belum Bayar</span>
                    <?php elseif ($status == 'menunggu verifikasi'): ?>
                        <span style="color:orange;">Menunggu Verifikasi</span>
                    <?php elseif ($status == 'lunas'): ?>
                        <span style="color:green;">Lunas</span>
                    <?php elseif ($status == 'ditolak'): ?>
                        <span style="color:red;">Ditolak</span>
                    <?php endif; ?>
                </td>

                <!-- METODE -->
                <td><?= $d['metode_pembayaran'] ?? '-' ?></td>

                <!-- BUKTI -->
                <td>
                    <?php if (!empty($d['bukti_pembayaran'])): ?>
                        <a href="<?= base_url('uploads/' . $d['bukti_pembayaran']) ?>" target="_blank">
                            Lihat Bukti
                        </a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                <!-- PETUGAS -->
                <td>
                    <?= $d['nama_petugas_verif'] ?? '-' ?>
                </td>

                <!-- AKSI -->
                <td>

                    <?php if ($status == 'belum bayar' && $role == 'anggota'): ?>

                        <!-- FORM BAYAR -->
                        <form action="<?= base_url('denda/bayar/' . $d['id_denda']) ?>"
                            method="post"
                            enctype="multipart/form-data">

                            <!-- METODE -->
                            <div style="margin-bottom:5px;">
                                <small>Metode</small><br>
                                <select name="metode_pembayaran" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="cash">Cash</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>

                            <!-- BUKTI -->
                            <div style="margin-bottom:5px;">
                                <small>Bukti Pembayaran</small><br>
                                <input type="file" name="bukti_pembayaran" required>
                            </div>

                            <!-- BUTTON -->
                            <button type="submit">💳 Bayar</button>

                        </form>

                    <?php elseif ($status == 'menunggu verifikasi'): ?>
                        <span style="color:orange;">⏳ Menunggu Verifikasi</span>

                    <?php elseif ($status == 'lunas'): ?>
                        <span style="color:green;">✔ Lunas</span>

                    <?php elseif ($status == 'ditolak' && $role == 'anggota'): ?>
                        <a href="<?= base_url('denda/bayar/' . $d['id_denda']) ?>">Bayar Ulang</a>
                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; ?>
    <?php else: ?>

        <tr>
            <td colspan="9" style="text-align:center;">
                Tidak ada data denda
            </td>
        </tr>

    <?php endif; ?>

</table>

<?= $this->endSection() ?>