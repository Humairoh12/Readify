<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    body {
        background: linear-gradient(135deg, #dfe9f3, #ffffff);
        font-family: 'Poppins', sans-serif;
    }

    .dashboard-wrapper {
        padding: 20px;
    }

    /* GLASS CARD */
    .glass-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
    }

    .glass-card:hover {
        transform: translateY(-5px);
    }

    /* CARD STAT WARNA */
    .card-stat {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-radius: 18px;
        color: #2f3e55;
        font-weight: 500;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: 0.3s;
    }

    .card-stat:hover {
        transform: translateY(-5px);
    }

    .card-stat h3 {
        margin: 0;
        font-weight: bold;
    }

    .icon {
        font-size: 35px;
    }

    /* WARNA SOFT */
    .bg-buku {
        background: linear-gradient(135deg, #dbeafe, #eff6ff);
    }

    .bg-anggota {
        background: linear-gradient(135deg, #dcfce7, #f0fdf4);
    }

    .bg-pinjam {
        background: linear-gradient(135deg, #ede9fe, #f5f3ff);
    }

    h4 {
        font-weight: 600;
    }
</style>

<div class="dashboard-wrapper">
    <div class="container-fluid">

        <!-- HEADER -->
        <div class="glass-card p-4 mb-4">
            <h4>Dashboard</h4>
            <p>Selamat datang di <b>Readify App</b> 👋</p>
        </div>

        <!-- CARD WARNA -->
        <div class="row">

            <div class="col-md-4">
                <div class="card-stat bg-buku">
                    <div>
                        <h6>Total Buku</h6>
                        <h3><?= $total_buku ?></h3>
                    </div>
                    <div class="icon">📚</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-stat bg-anggota">
                    <div>
                        <h6>Total Anggota</h6>
                        <h3><?= $total_anggota ?></h3>
                    </div>
                    <div class="icon">👤</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-stat bg-pinjam">
                    <div>
                        <h6>Peminjaman</h6>
                        <h3><?= $total_peminjaman ?></h3>
                    </div>
                    <div class="icon">📦</div>
                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="glass-card p-4 mt-4">
            <h5 class="mb-3">📋 Peminjaman Terbaru</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Buku</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($peminjaman_terbaru)) : ?>
                            <?php foreach ($peminjaman_terbaru as $p) : ?>
                                <tr>
                                    <td><?= $p['nama'] ?></td>
                                    <td><?= $p['judul'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">Belum ada data</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>