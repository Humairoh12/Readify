<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Peminjaman</h3>

<?php if (session()->get('role') == 'anggota') : ?>
    <a href="<?= base_url('peminjaman/create') ?>">+ Tambah</a>
<?php endif; ?>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Anggota</th>
        <th>Petugas</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1;
    foreach ($peminjaman as $p): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p['nama_anggota'] ?></td>
            <td><?= $p['nama_petugas'] ?></td>
            <td><?= $p['tanggal_pinjam'] ?></td>
            <td><?= $p['tanggal_kembali'] ?></td>
            <td><?= $p['status'] ?></td>
            <td>
            <td class="aksi">

                <!-- 🔍 DETAIL -->
                <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>"
                    class="btn-circle detail" title="Detail">
                    🔍
                </a>

                <?php if ($p['status'] != 'dikembalikan') : ?>
                    <!-- 🔄 KEMBALI -->
                    <a href="<?= base_url('peminjaman/kembali/' . $p['id_peminjaman']) ?>"
                        class="btn-circle kembali" title="Kembalikan">
                        🔄
                    </a>
                <?php else: ?>
                    <!-- ✅ SUDAH -->
                    <span class="badge-selesai">✔</span>
                <?php endif; ?>

                <!-- 📱 WA -->
                <a href="<?= base_url('peminjaman/kirimWA/' . $p['id_peminjaman']) ?>"
                    target="_blank"
                    class="btn-circle wa"
                    title="WhatsApp">
                    💬
                </a>

                <!-- 🗑️ HAPUS -->
                <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
                    onclick="return confirm('Hapus?')"
                    class="btn-circle hapus"
                    title="Hapus">
                    🗑️
                </a>

            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>