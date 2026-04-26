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

    /* CARD */
    .glass-card {
        background: #ffffffcc;
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Tambah Penulis</h4>

        <a href="<?= base_url('penulis') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- 🔹 FORM -->
    <div class="glass-card p-4">

        <form action="<?= base_url('penulis/store') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Nama Penulis</label>
                <input type="text"
                    name="nama_penulis"
                    class="form-control"
                    placeholder="Masukkan nama penulis..."
                    required
                    autofocus>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('penulis') ?>" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>