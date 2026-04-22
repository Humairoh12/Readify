<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h3>Data Buku</h3>

    <!-- FORM PENCARIAN -->
    <form method="get" action="">

        <input type="text" name="keyword" placeholder="Cari judul..."
            value="<?= $_GET['keyword'] ?? '' ?>">

        <select name="kategori">
            <option value="">-- Semua Kategori --</option>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['id_kategori'] ?>"
                    <?= (($_GET['kategori'] ?? '') == $k['id_kategori']) ? 'selected' : '' ?>>
                    <?= $k['nama_kategori'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Cari</button>
        <a href="<?= base_url('buku') ?>">Reset</a>
        <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>" target="_blank">
            Print
        </a>
    </form>

    <br>

    <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>
        <a href="<?= base_url('buku/create') ?>">+ Tambah Buku</a>
    <?php endif; ?>

    <br><br>

    <?php if (session()->getFlashdata('success')): ?>
        <div><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="container-buku">

        <?php if (!empty($buku)): ?>

            <?php foreach ($buku as $b): ?>

                <div class="card-buku">

                    <!-- COVER -->
                    <div class="cover">
                        <?php if ($b['cover']): ?>
                            <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>">
                        <?php else: ?>
                            <div class="no-cover">No Image</div>
                        <?php endif; ?>
                    </div>

                    <!-- JUDUL -->
                    <h4><?= $b['judul'] ?></h4>

                    <p class="info"><?= $b['nama_kategori'] ?? '-' ?></p>

                    <p class="small">
                        ISBN: <?= $b['isbn'] ?>
                    </p>

                    <p class="small">
                        Stok: <?= $b['tersedia'] ?>/<?= $b['jumlah'] ?>
                    </p>

                    <!-- AKSI -->
                    <div class="aksi">

                        <!-- DETAIL -->
                        <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>" class="btn detail" title="Detail">🔍</a>

                        <!-- EDIT -->
                        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])): ?>
                            <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>" class="btn edit" title="Edit">✏️</a>
                        <?php endif; ?>

                        <!-- WA -->
                        <a href="<?= base_url('buku/kirimWA/' . $b['id_buku']) ?>" target="_blank" class="btn wa" title="WA">💬</a>

                        <!-- HAPUS -->
                        <?php if (session()->get('role') == 'admin'): ?>
                            <a href="<?= base_url('buku/delete/' . $b['id_buku']) ?>"
                                onclick="return confirm('Hapus buku ini?')"
                                class="btn hapus" title="Hapus">🗑️</a>
                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>
            <p>Belum ada data buku</p>
        <?php endif; ?>

    </div>
    <br>

    <!-- PAGINATION -->
    <div>
        <?= $pager->links() ?>
    </div>

</div>
<style>
    .container-buku {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    /* CARD */
    .card-buku {
        width: 180px;
        background: #fff;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: 0.2s;
    }

    .card-buku:hover {
        transform: translateY(-5px);
    }

    /* COVER */
    .cover img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 10px;
    }

    .no-cover {
        width: 100%;
        height: 220px;
        background: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    /* TEXT */
    .card-buku h4 {
        font-size: 14px;
        margin: 8px 0 5px;
    }

    .info {
        font-size: 12px;
        color: gray;
    }

    .small {
        font-size: 11px;
        color: #666;
    }

    /* AKSI */
    .aksi {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 8px;
    }

    /* BUTTON */
    .btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #fff;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn:hover {
        transform: scale(1.15);
    }

    /* COLOR */
    .detail {
        background: #3498db;
    }

    .edit {
        background: #f39c12;
    }

    .wa {
        background: #25D366;
    }

    .hapus {
        background: #e74c3c;
    }
</style>
<?= $this->endSection() ?>