<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card-custom">
    <h3 class="title">Tambah Rak</h3>

    <form action="<?= base_url('rak/store') ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Nama Rak</label>
            <input type="text" name="nama_rak" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary btn-custom">Simpan</button>
        <a href="<?= base_url('rak') ?>" class="btn btn-secondary btn-custom">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>