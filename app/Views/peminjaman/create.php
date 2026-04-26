<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* GRID BUKU (KECIL & RAPI) */
    .buku-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    /* CARD KECIL */
    .buku-card {
        width: 140px;
        background: #fff;
        border-radius: 10px;
        padding: 8px;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: 0.2s;
    }

    .buku-card:hover {
        transform: scale(1.05);
    }

    /* COVER KECIL */
    .buku-card img.buku-cover {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* JUDUL */
    .buku-card h6 {
        font-size: 12px;
        margin: 5px 0;
    }

    /* AKSI */
    .buku-card .aksi {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    /* SELECT ACTIVE */
    .selectable-card.active {
        border: 2px solid #28a745;
    }
</style>

<div class="dashboard-wrapper">

    <!-- 🔹 HEADER -->
    <div class="glass-card p-4 mb-4">
        <h4 class="mb-0">📥 Tambah Peminjaman</h4>
    </div>

    <form action="<?= base_url('peminjaman/store') ?>" method="post">

        <!-- 🔹 FILTER -->
        <div class="glass-card p-3 mb-4">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" id="search" class="form-control"
                        placeholder="Cari buku..." onkeyup="filterBuku()">
                </div>

                <div class="col-md-6">
                    <select id="kategori" class="form-select" onchange="filterBuku()">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id_kategori'] ?>">
                                <?= $k['nama_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- 🔹 GRID BUKU -->
        <div id="listBuku" class="buku-grid">

            <?php foreach ($buku as $b): ?>
                <div class="buku-card selectable-card"
                    data-judul="<?= strtolower($b['judul']) ?>"
                    data-kategori="<?= $b['id_kategori'] ?>">

                    <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>" class="buku-cover">

                    <h6><?= $b['judul'] ?></h6>

                    <input type="radio" name="id_buku" value="<?= $b['id_buku'] ?>" hidden>

                    <div class="aksi mt-2">

                        <button type="button"
                            onclick="pilihBuku(this)"
                            class="btn btn-success btn-sm">
                            <i class="bi bi-book"></i>
                        </button>

                        <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>"
                            class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- 🔹 PETUGAS -->
        <div class="glass-card p-3 mt-4">
            <label class="form-label">Petugas</label>
            <select name="id_petugas" class="form-select" required>
                <?php foreach ($petugas as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 🔹 BUTTON -->
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>

    </form>

</div>

<!-- 🔥 SCRIPT -->
<script>
    function pilihBuku(btn) {
        document.querySelectorAll('.selectable-card').forEach(c => c.classList.remove('active'));

        let card = btn.closest('.selectable-card');
        card.classList.add('active');

        card.querySelector('input').checked = true;
    }

    function filterBuku() {
        let search = document.getElementById("search").value.toLowerCase();
        let kategori = document.getElementById("kategori").value;

        document.querySelectorAll(".selectable-card").forEach(function(b) {
            let judul = b.dataset.judul;
            let kat = b.dataset.kategori;

            let cocok = judul.includes(search) && (kategori === "" || kat === kategori);

            b.style.display = cocok ? "block" : "none";
        });
    }
</script>

<?= $this->endSection() ?>