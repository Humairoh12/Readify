<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* FORM */
    .form-label {
        font-weight: 600;
        color: #555;
    }

    .form-control {
        border-radius: 8px;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Edit Kategori</h4>

        <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- 🔹 FORM -->
    <div class="glass-card p-4">

        <form action="<?= base_url('kategori/update/' . $row['id_kategori']) ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text"
                    name="nama_kategori"
                    value="<?= $row['nama_kategori'] ?>"
                    class="form-control"
                    required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>

                <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>