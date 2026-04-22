<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Penerbit</h3>

<form action="<?= base_url('penerbit/update/' . $row['id_penerbit']) ?>" method="post">
    <label>Nama Penerbit</label><br>
    <input type="text" name="nama_penerbit" value="<?= $row['nama_penerbit'] ?>"><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat"><?= $row['alamat'] ?></textarea><br><br>

    <button type="submit">Update</button>
    <a href="<?= base_url('penerbit') ?>">Kembali</a>
</form>

<?= $this->endSection() ?>