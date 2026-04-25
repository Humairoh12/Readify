<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Rak</h3>
<!-- FORM PENCARIAN -->
<form method="get" action="">

    <input type="text" name="keyword" placeholder="Cari judul..."
        value="<?= $_GET['keyword'] ?? '' ?>">



    <button type="submit">Cari</button>
    <a href="<?= base_url('buku') ?>">Reset</a>
    <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>" target="_blank">
        Print
    </a>
</form>
<br>
<a href="<?= base_url('rak/create') ?>">+ Tambah</a>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama Rak</th>
        <th>Lokasi</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1;
    foreach ($rak as $d): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nama_rak'] ?></td>
            <td><?= $d['lokasi'] ?></td>
            <td>
                <a href="<?= base_url('rak/edit/' . $d['id_rak']) ?>">Edit</a>
                <a href="<?= base_url('rak/delete/' . $d['id_rak']) ?>"
                    onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>