<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* FORM */
    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px;
    }

    /* LABEL */
    .form-label {
        font-weight: 500;
    }

    /* PREVIEW COVER */
    .preview-img {
        width: 120px;
        height: 160px;
        object-fit: cover;
        border-radius: 10px;
    }

    /* TEXTAREA */
    textarea.form-control {
        resize: none;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Edit Buku</h4>

        <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- 🔹 FORM -->
    <div class="glass-card p-4">

        <form action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" method="post" enctype="multipart/form-data">

            <div class="row">

                <!-- KIRI -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control"
                            value="<?= $buku['judul'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control"
                            value="<?= $buku['isbn'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>"
                                    <?= ($buku['id_kategori'] == $k['id_kategori']) ? 'selected' : '' ?>>
                                    <?= $k['nama_kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <select name="id_penulis" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($penulis as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>"
                                    <?= ($buku['id_penulis'] == $p['id_penulis']) ? 'selected' : '' ?>>
                                    <?= $p['nama_penulis'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control"
                            value="<?= $buku['tahun_terbit'] ?>">
                    </div>

                </div>

                <!-- KANAN -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <select name="id_penerbit" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($penerbit as $p): ?>
                                <option value="<?= $p['id_penerbit'] ?>"
                                    <?= ($buku['id_penerbit'] == $p['id_penerbit']) ? 'selected' : '' ?>>
                                    <?= $p['nama_penerbit'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="penerbit_baru" class="form-control mt-2"
                            placeholder="Atau tulis penerbit baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rak</label>
                        <select name="id_rak" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($rak as $r): ?>
                                <option value="<?= $r['id_rak'] ?>"
                                    <?= ($buku['id_rak'] == $r['id_rak']) ? 'selected' : '' ?>>
                                    <?= $r['nama_rak'] ?> - <?= $r['lokasi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="rak_baru" class="form-control mt-2"
                            placeholder="Atau tulis rak baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control"
                            value="<?= $buku['jumlah'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tersedia</label>
                        <input type="number" name="tersedia" class="form-control"
                            value="<?= $buku['tersedia'] ?>">
                    </div>

                </div>

            </div>

            <!-- DESKRIPSI -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?= $buku['deskripsi'] ?></textarea>
            </div>

            <!-- COVER -->
            <div class="mb-3 text-center">
                <label class="form-label">Cover</label><br>

                <?php if ($buku['cover']): ?>
                    <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>"
                        class="preview-img mb-2">
                <?php endif; ?>

                <input type="file" name="cover" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin ganti</small>
            </div>

            <!-- BUTTON -->
            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>

                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>