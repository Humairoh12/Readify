<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Pengembalian</h3>

<a href="<?= base_url('pengembalian/create') ?>">+ Pengembalian</a>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>ID Peminjaman</th>
        <th>Tanggal Dikembalikan</th>
        <th>Denda</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1;
    foreach ($pengembalian as $p): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p['id_peminjaman'] ?></td>
            <td><?= $p['tanggal_dikembalikan'] ?></td>
            <td>Rp <?= number_format($p['denda']) ?></td>
            <td>
                <a href="<?= base_url('pengembalian/delete/' . $p['id_pengembalian']) ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>