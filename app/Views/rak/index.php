<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card-custom">
    <h3 class="title">Data Rak</h3>

    <!-- FORM -->
    <form method="get" class="mb-3 d-flex gap-2 flex-wrap">
        <input type="text" name="keyword" class="form-control"
            placeholder="Cari rak..."
            value="<?= $_GET['keyword'] ?? '' ?>">

        <button class="btn btn-primary btn-custom">Cari</button>

        <a href="<?= base_url('rak') ?>" class="btn btn-secondary btn-custom">Reset</a>

        <a href="<?= base_url('rak/print?' . http_build_query($_GET)) ?>" target="_blank"
            class="btn btn-success btn-custom">Print</a>
    </form>

    <!-- BUTTON TAMBAH -->
    <a href="<?= base_url('rak/create') ?>" class="btn btn-primary mb-3">
        + Tambah
    </a>

    <!-- TABLE -->
    <table class="table table-bordered table-custom">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Rak</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;
            foreach ($rak as $d): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama_rak'] ?></td>
                    <td><?= $d['lokasi'] ?></td>
                    <td>
                        <a href="<?= base_url('rak/edit/' . $d['id_rak']) ?>"
                            class="btn btn-warning btn-sm" title="Edit">
                            ✏️
                        </a>

                        <a href="<?= base_url('rak/delete/' . $d['id_rak']) ?>"
                            onclick="return confirm('Hapus?')"
                            class="btn btn-danger btn-sm" title="Hapus">
                            🗑️
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>