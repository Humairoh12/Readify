<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* TABLE GLOBAL */
    .table th {
        font-weight: 600;
        color: #555;
    }

    .table td {
        vertical-align: middle;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Kategori</h4>

        <a href="<?= base_url('kategori/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
    </div>

    <!-- 🔹 FILTER -->
    <div class="glass-card p-3 mb-4">
        <form method="get" class="row g-2">

            <div class="col-md-6">
                <input type="text" name="keyword"
                    class="form-control"
                    placeholder="Cari kategori..."
                    value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>

                <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">
                    Reset
                </a>

                <a href="<?= base_url('kategori/print?' . http_build_query($_GET)) ?>"
                    target="_blank"
                    class="btn btn-success">
                    <i class="bi bi-printer"></i> Print
                </a>
            </div>

        </form>
    </div>

    <!-- 🔹 TABLE -->
    <div class="glass-card p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Kategori</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($kategori)): ?>
                        <?php $no = 1;
                        foreach ($kategori as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['nama_kategori'] ?></td>

                                <td>
                                    <a href="<?= base_url('kategori/edit/' . $d['id_kategori']) ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('kategori/delete/' . $d['id_kategori']) ?>"
                                        onclick="return confirm('Hapus data?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data kategori
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>