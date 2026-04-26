<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* ===== GRID BUKU ===== */
    .buku-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    /* ===== CARD ===== */
    .buku-card {
        width: 200px;
        padding: 12px;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: 0.25s;
    }

    .buku-card:hover {
        transform: translateY(-6px) scale(1.02);
    }

    /* ===== COVER ===== */
    .buku-cover img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        border-radius: 10px;
    }

    .no-cover {
        width: 100%;
        height: 230px;
        background: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 12px;
    }

    /* ===== TEXT ===== */
    .buku-card h6 {
        font-size: 14px;
        font-weight: 600;
    }

    /* ===== AKSI ===== */
    .aksi {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        gap: 6px;
    }

    /* ===== BUTTON SMALL ===== */
    .btn-sm {
        border-radius: 8px;
        padding: 5px 7px;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Buku</h4>

        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>
            <a href="<?= base_url('buku/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Buku
            </a>
        <?php endif; ?>
    </div>

    <!-- 🔹 FILTER -->
    <div class="glass-card p-3 mb-4">
        <form method="get" class="row g-2">

            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control"
                    placeholder="Cari judul..."
                    value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-md-3">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?= $k['id_kategori'] ?>"
                            <?= (($_GET['kategori'] ?? '') == $k['id_kategori']) ? 'selected' : '' ?>>
                            <?= $k['nama_kategori'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-5 d-flex gap-2">
                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>

                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Reset</a>

                <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>"
                    target="_blank" class="btn btn-success">
                    <i class="bi bi-printer"></i> print
                </a>
            </div>

        </form>
    </div>

    <!-- 🔹 ALERT -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- 🔹 GRID BUKU -->
    <div class="buku-grid">

        <?php if (!empty($buku)): ?>
            <?php foreach ($buku as $b): ?>

                <div class="buku-card">

                    <!-- COVER -->
                    <div class="buku-cover">
                        <?php if ($b['cover']): ?>
                            <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>">
                        <?php else: ?>
                            <div class="no-cover">No Image</div>
                        <?php endif; ?>
                    </div>

                    <!-- INFO -->
                    <h6 class="mt-2"><?= $b['judul'] ?></h6>
                    <p class="text-muted small"><?= $b['nama_kategori'] ?? '-' ?></p>

                    <p class="small mb-1">ISBN: <?= $b['isbn'] ?></p>
                    <p class="small">Stok: <?= $b['tersedia'] ?>/<?= $b['jumlah'] ?></p>

                    <!-- AKSI -->
                    <div class="aksi">

                        <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>"
                            class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>

                        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])): ?>
                            <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                        <?php endif; ?>

                        <a href="<?= base_url('buku/kirimWA/' . $b['id_buku']) ?>"
                            target="_blank"
                            class="btn btn-success btn-sm">
                            <i class="bi bi-whatsapp"></i>
                        </a>

                        <?php if (session()->get('role') == 'admin'): ?>
                            <a href="<?= base_url('buku/delete/' . $b['id_buku']) ?>"
                                onclick="return confirm('Hapus buku ini?')"
                                class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Belum ada data buku</p>
        <?php endif; ?>

    </div>

    <!-- 🔹 PAGINATION -->
    <div class="mt-4">
        <?= $pager->links() ?>
    </div>

</div>

<?= $this->endSection() ?>