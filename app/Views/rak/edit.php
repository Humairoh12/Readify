<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card-custom">
    <h3 class="title">Edit Rak</h3>

    <form action="<?= base_url('rak/update/' . $row['id_rak']) ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Nama Rak</label>
            <input type="text" name="nama_rak"
                value="<?= $row['nama_rak'] ?>"
                class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi"
                value="<?= $row['lokasi'] ?>"
                class="form-control" required>
        </div>

        <!-- BUTTON -->
        <button type="submit" class="btn btn-primary btn-custom">💾 Update</button>
        <a href="<?= base_url('rak') ?>" class="btn btn-secondary btn-custom">⬅️ Kembali</a>

        <!-- AKSI TAMBAHAN -->
        <div class="mt-3">
            <a href="<?= base_url('rak') ?>" class="btn-aksi btn-detail">🔍 Lihat Data</a>

            <a href="<?= base_url('rak/delete/' . $row['id_rak']) ?>"
                onclick="return confirm('Yakin hapus data ini?')"
                class="btn-aksi btn-hapus">🗑️ Hapus</a>
        </div>

    </form>
</div>

<?= $this->endSection() ?>