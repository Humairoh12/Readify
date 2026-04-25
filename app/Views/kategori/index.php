<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Kategori</h3>
<!-- FORM PENCARIAN -->
<form method="get" action="">

    <input type="text" name="keyword" placeholder="Cari kategori..."
        value="<?= $_GET['keyword'] ?? '' ?>">



    <button type="submit">Cari</button>
    <a href="<?= base_url('buku') ?>">Reset</a>
    <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>" target="_blank">
        Print
    </a>
</form>

<br>
<a href="<?= base_url('kategori/create') ?>">+ Tambah</a>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1;
    foreach ($kategori as $d): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nama_kategori'] ?></td>
            <td>
                <a href="<?= base_url('kategori/edit/' . $d['id_kategori']) ?>">Edit</a>
                <a href="<?= base_url('kategori/delete/' . $d['id_kategori']) ?>">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>