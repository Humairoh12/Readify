<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Penerbit</h3>
<!-- FORM PENCARIAN -->
<form method="get" action="">

    <input type="text" name="keyword" placeholder="Cari penerbit..."
        value="<?= $_GET['keyword'] ?? '' ?>">



    <button type="submit">Cari</button>
    <a href="<?= base_url('buku') ?>">Reset</a>
    <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>" target="_blank">
        Print
    </a>
</form>

<br>
<a href="<?= base_url('penerbit/create') ?>">+ Tambah</a>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1;
    foreach ($penerbit as $d): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nama_penerbit'] ?></td>
            <td><?= $d['alamat'] ?></td>
            <td>
                <a href="<?= base_url('penerbit/edit/' . $d['id_penerbit']) ?>">Edit</a>
                <a href="<?= base_url('penerbit/delete/' . $d['id_penerbit']) ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>