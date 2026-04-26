<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* COVER DETAIL */
    .detail-cover {
        width: 160px;
        height: 220px;
        object-fit: cover;
        border-radius: 10px;
    }

    /* TABLE DETAIL */
    .detail-table th {
        width: 160px;
        font-weight: 600;
        color: #555;
    }

    .detail-table td {
        color: #333;
    }

    .detail-table tr {
        border-bottom: 1px solid #eee;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Detail Buku</h4>

        <div class="d-flex gap-2">
            <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <a href="<?= base_url('buku/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Tambah
            </a>
        </div>
    </div>

    <!-- 🔹 CONTENT -->
    <div class="glass-card p-4">

        <div class="row">

            <!-- COVER -->
            <div class="col-md-4 text-center mb-3">
                <?php if ($buku['cover']): ?>
                    <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>"
                        class="detail-cover shadow-sm">
                <?php else: ?>
                    <div class="no-cover">No Image</div>
                <?php endif; ?>
            </div>

            <!-- DATA -->
            <div class="col-md-8">

                <table class="table table-borderless detail-table">

                    <tr>
                        <th>Judul</th>
                        <td><?= $buku['judul'] ?></td>
                    </tr>

                    <tr>
                        <th>ISBN</th>
                        <td><?= $buku['isbn'] ?></td>
                    </tr>

                    <tr>
                        <th>Kategori</th>
                        <td><?= $buku['nama_kategori'] ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th>Penulis</th>
                        <td><?= $buku['nama_penulis'] ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th>Penerbit</th>
                        <td><?= $buku['nama_penerbit'] ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th>Rak</th>
                        <td><?= $buku['nama_rak'] ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th>Lokasi</th>
                        <td><?= $buku['lokasi'] ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th>Tahun</th>
                        <td><?= $buku['tahun_terbit'] ?></td>
                    </tr>

                    <tr>
                        <th>Stok</th>
                        <td>
                            <span class="badge bg-success">
                                <?= $buku['tersedia'] ?> tersedia
                            </span>
                            /
                            <span class="badge bg-secondary">
                                <?= $buku['jumlah'] ?> total
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Deskripsi</th>
                        <td><?= $buku['deskripsi'] ?></td>
                    </tr>

                    <tr>
                        <th>Dibuat</th>
                        <td><?= $buku['created_at'] ?></td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>