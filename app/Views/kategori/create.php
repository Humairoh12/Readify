<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Kategori</h3>

<form action="<?= base_url('kategori/store') ?>" method="post">
    <input type="text" name="nama_kategori">
    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>