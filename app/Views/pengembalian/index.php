<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Pengembalian</h3>
<!-- FORM PENCARIAN -->
<form method="get" action="">

    <input type="text" name="keyword" placeholder="Cari data..."
        value="<?= $_GET['keyword'] ?? '' ?>">



    <button type="submit">Cari</button>
    <a href="<?= base_url('buku') ?>">Reset</a>
    <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>" target="_blank">
        Print
    </a>
</form>
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