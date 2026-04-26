<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* FORM */
    .form-label {
        font-weight: 600;
        color: #555;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Form Pengembalian</h4>

        <a href="<?= base_url('pengembalian') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- 🔹 FORM -->
    <div class="glass-card p-4">

        <form action="<?= base_url('pengembalian/store') ?>" method="post">

            <!-- PEMINJAMAN -->
            <div class="mb-3">
                <label class="form-label">Peminjaman</label>
                <select name="id_peminjaman" class="form-select" required>
                    <option value="">-- Pilih Peminjaman --</option>
                    <?php foreach ($peminjaman as $p): ?>
                        <option value="<?= $p['id_peminjaman'] ?>">
                            ID <?= $p['id_peminjaman'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- TANGGAL -->
            <div class="mb-3">
                <label class="form-label">Tanggal Dikembalikan</label>
                <input type="date" name="tanggal_dikembalikan" class="form-control" required>
            </div>

            <!-- BUTTON -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('pengembalian') ?>" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>