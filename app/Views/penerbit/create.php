<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card-custom">
    <h3 class="title">Tambah Penerbit</h3>

    <form action="<?= base_url('penerbit/store') ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Nama Penerbit</label>
            <input type="text" name="nama_penerbit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-custom">Simpan</button>
        <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary btn-custom">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>