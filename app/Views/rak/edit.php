<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Rak</h3>

<form action="<?= base_url('rak/update/' . $row['id_rak']) ?>" method="post">

    <label>Nama Rak</label><br>
    <input type="text" name="nama_rak" value="<?= $row['nama_rak'] ?>"><br><br>

    <label>Lokasi</label><br>
    <input type="text" name="lokasi" value="<?= $row['lokasi'] ?>"><br><br>

    <button type="submit">Update</button>
    <a href="<?= base_url('rak') ?>">Kembali</a>

</form>

<?= $this->endSection() ?>