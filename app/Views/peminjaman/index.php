<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>📚 Data Peminjaman</h3>

<!-- FORM PENCARIAN -->
<form method="get" action="">
    <input type="text" name="keyword" placeholder="Cari peminjaman ..."
        value="<?= $_GET['keyword'] ?? '' ?>">

    <button type="submit">🔍 Cari</button>
    <a href="<?= base_url('peminjaman') ?>">Reset</a>
</form>

<br>

<?php if (session()->get('role') == 'anggota') : ?>
    <a href="<?= base_url('peminjaman/create') ?>">➕ Tambah</a>
<?php endif; ?>

<table border="1" cellpadding="6" width="100%">
    <tr>
        <th>No</th>
        <th>Anggota</th>
        <th>Petugas</th>
        <th>Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Jatuh Tempo</th>
        <th>Status</th>
        <th>Denda</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1;
    foreach ($peminjaman as $p): ?>

        <?php
        $denda = $p['denda'] ?? 0;
        ?>

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
                    📖 Dipinjam
                <?php elseif ($p['status'] == 'terlambat'): ?>
                    <span style="color:red;">⚠ Terlambat</span>
                <?php else: ?>
                    <span style="color:green;">✔ Kembali</span>
                <?php endif; ?>
            </td>

            <!-- 🔥 DENDA -->
            <td style="color: <?= $denda > 0 ? 'red' : 'green' ?>">
                Rp <?= number_format($denda, 0, ',', '.') ?>
            </td>

            <td>

                <!-- DETAIL -->
                <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>">
                    🔍 Detail
                </a> |

                <!-- PERPANJANG -->
                <a href="<?= base_url('/peminjaman/perpanjang/' . $p['id_peminjaman']) ?>">
                    🔁 Perpanjang
                </a> |

                <!-- KEMBALIKAN -->
                <?php if (in_array(session()->get('role'), ['admin', 'petugas'])): ?>
                    <a href="<?= base_url('peminjaman/kembalikan/' . $p['id_peminjaman']) ?>">
                        🔄 Kembali
                    </a>
                <?php endif; ?>

                <!-- WA -->
                <a href="<?= base_url('peminjaman/kirimWA/' . $p['id_peminjaman']) ?>" target="_blank">
                    📱 Kirim WA
                </a>

                <br>

                <!-- 💳 PEMBAYARAN -->
                <?php if ($denda > 0): ?>

                    <?php if ($p['status_bayar'] == 'belum'): ?>

                        <a href="<?= base_url('denda') ?>" style="color:red;">
                            💰 Bayar di menu denda
                        </a>

                    <?php elseif ($p['status_bayar'] == 'lunas'): ?>

                        <span style="color:green;">✔ Lunas</span>

                    <?php endif; ?>

                <?php endif; ?>

                <br>

                <!-- HAPUS -->
                <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
                    onclick="return confirm('Hapus?')">
                    🗑 Hapus
                </a>

            </td>
        </tr>

    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>