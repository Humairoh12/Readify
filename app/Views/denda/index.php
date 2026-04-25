<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Denda</h2>

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
        <th>Jumlah</th>
        <th>Status</th>
        <th>Metode</th>
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

                <!-- ID PEMINJAMAN -->
                <td><?= $d['id_peminjaman'] ?? '-' ?></td>


                <!-- JUMLAH -->
                <td>
                    <?php if (!empty($d['jumlah_denda']) && $d['jumlah_denda'] > 0): ?>
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
                <td>
                    <?php if (!empty($d['metode_pembayaran'])): ?>
                        <span style="text-transform:uppercase;">
                            <?= esc($d['metode_pembayaran']) ?>
                        </span>
                    <?php else: ?>
                        <span style="color:gray;">-</span>
                    <?php endif; ?>
                </td>



                <!-- AKSI -->
                <td>

                    <?php if ($status == 'belum bayar' && $role == 'anggota'): ?>

                        <form action="<?= base_url('denda/bayar/' . $d['id_denda']) ?>"
                            method="post"
                            enctype="multipart/form-data">

                            <!-- METODE -->
                            <select name="metode_pembayaran" id="metode-<?= $d['id_denda'] ?>" required
                                onchange="toggleBukti(<?= $d['id_denda'] ?>)">

                                <option value="cash">Cash</option>

                            </select>

                            <br><br>

                            <!-- BUKTI -->
                            <div id="bukti-box-<?= $d['id_denda'] ?>" style="display:none;">
                                <input type="file" name="bukti_pembayaran">
                                <br><br>
                            </div>

                            <button type="submit">💳 Bayar</button>
                        </form>

                    <?php elseif ($status == 'menunggu verifikasi'): ?>

                        <?php if (in_array($role, ['admin', 'petugas'])): ?>
                            <a href="<?= base_url('denda/verifikasi/' . $d['id_denda']) ?>" style="color:green;">
                                ✔ Verifikasi
                            </a>
                        <?php else: ?>
                            <span style="color:orange;">⏳ Menunggu</span>
                        <?php endif; ?>

                    <?php elseif ($status == 'lunas'): ?>
                        <span style="color:green;">✔ Lunas</span>
                        <?php if ($role == 'admin'): ?>
                            <form action="<?= base_url('denda/hapus/' . $d['id_denda']) ?>"
                                method="post"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin hapus data ini?')">

                                <button type="submit" style="background:red;color:white;border:none;padding:5px;">
                                    🗑 Hapus
                                </button>
                            </form>
                        <?php endif; ?>
                    <?php elseif ($status == 'ditolak'): ?>
                        <?php if ($role == 'anggota'): ?>
                            <a href="<?= base_url('denda/bayar/' . $d['id_denda']) ?>">Bayar Ulang</a>
                        <?php else: ?>
                            <span style="color:red;">Ditolak</span>
                        <?php endif; ?>
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
<!-- 🔥 INI TEMPATNYA SCRIPT -->
<script>
    function toggleBukti(id) {
        let metode = document.getElementById('metode-' + id);
        let box = document.getElementById('bukti-box-' + id);

        if (!metode || !box) return;

        if (metode.value === 'qris') {
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    }

    // 🔥 auto jalan saat halaman load
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($denda as $d): ?>
            toggleBukti(<?= $d['id_denda'] ?>);
        <?php endforeach; ?>
    });
</script>

<?= $this->endSection() ?>