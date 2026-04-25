<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Penulis</h3>
<!-- FORM PENCARIAN -->
<form method="get" action="">

    <input type="text" name="keyword" placeholder="Cari penulis..."
        value="<?= $_GET['keyword'] ?? '' ?>">



    <button type="submit">Cari</button>
    <a href="<?= base_url('buku') ?>">Reset</a>
    <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>" target="_blank">
        Print
    </a>
</form>
<br>
<a href="<?= base_url('penulis/create') ?>">+ Tambah</a>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama Penulis</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1;
    foreach ($penulis as $d): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nama_penulis'] ?></td>
            <td>
                <a href="<?= base_url('penulis/edit/' . $d['id_penulis']) ?>">Edit</a>
                <a href="<?= base_url('penulis/delete/' . $d['id_penulis']) ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>