<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* TABLE */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    /* BUTTON */
    .btn-sm {
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
        <h4 class="mb-0">Data Penerbit</h4>

        <a href="<?= base_url('penerbit/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
    </div>

    <!-- 🔹 FILTER -->
    <div class="glass-card p-3 mb-4">
        <form method="get" class="row g-2 align-items-center">

            <div class="col-md-4">
                <input type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari penerbit..."
                    value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary">
                    Reset
                </a>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('penerbit/print?' . http_build_query($_GET)) ?>"
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
                        <th width="50">No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($penerbit)): ?>
                        <?php $no = 1;
                        foreach ($penerbit as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['nama_penerbit'] ?></td>
                                <td><?= $d['alamat'] ?></td>

                                <td>
                                    <a href="<?= base_url('penerbit/edit/' . $d['id_penerbit']) ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('penerbit/delete/' . $d['id_penerbit']) ?>"
                                        onclick="return confirm('Hapus?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data penerbit
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>