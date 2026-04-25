<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Scan QRIS untuk bayar</h3>

<img src="<?= base_url('assets/qris.png') ?>" width="200">

<br><br>

<a href="<?= base_url('peminjaman/bayar/' . $id . '/qris') ?>">
    Saya sudah bayar
</a>

<?= $this->endSection() ?>