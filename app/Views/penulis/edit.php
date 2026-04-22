<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Penulis</h3>

<form action="<?= base_url('penulis/update/' . $row['id_penulis']) ?>" method="post">
    <label>Nama Penulis</label><br>
    <input type="text" name="nama_penulis" value="<?= $row['nama_penulis'] ?>"><br><br>

    <button type="submit">Update</button>
    <a href="<?= base_url('penulis') ?>">Kembali</a>
</form>

<?= $this->endSection() ?>