<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Tambah Buku</h4>

        <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- 🔹 FORM -->
    <div class="glass-card p-4">

        <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">

            <div class="row">

                <!-- KIRI -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <textarea name="judul" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>">
                                    <?= $k['nama_kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="kategori_baru"
                            class="form-control mt-2"
                            placeholder="Atau tambah kategori baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <select name="id_penulis" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($penulis as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>">
                                    <?= $p['nama_penulis'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="penulis_baru"
                            class="form-control mt-2"
                            placeholder="Atau tambah penulis baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control">
                    </div>

                </div>

                <!-- KANAN -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <select name="id_penerbit" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($penerbit as $p): ?>
                                <option value="<?= $p['id_penerbit'] ?>">
                                    <?= $p['nama_penerbit'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="penerbit_baru"
                            class="form-control mt-2"
                            placeholder="Atau tambah penerbit baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rak</label>
                        <select name="id_rak" class="form-select">
                            <option value="">-- Pilih Rak --</option>
                            <?php foreach ($rak as $r): ?>
                                <option value="<?= $r['id_rak'] ?>">
                                    <?= $r['nama_rak'] ?> - <?= $r['lokasi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3 text-center">
                        <label class="form-label">Cover</label>
                        <input type="file" name="cover" class="form-control">
                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>