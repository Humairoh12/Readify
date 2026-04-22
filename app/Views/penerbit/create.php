<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Penerbit</h3>

<form action="<?= base_url('penerbit/store') ?>" method="post">
    <label>Nama Penerbit</label><br>
    <input type="text" name="nama_penerbit"><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat"></textarea><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= base_url('penerbit') ?>">Kembali</a>
</form>

<?= $this->endSection() ?>