<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>📥 Tambah Peminjaman</h3>

<form action="<?= base_url('peminjaman/store') ?>" method="post">

    <!-- 🔍 SEARCH + KATEGORI -->
    <div style="display:flex; gap:10px;">
        <input type="text" id="search" placeholder="Cari buku..." onkeyup="filterBuku()">

        <select id="kategori" onchange="filterBuku()">
            <option value="">Semua Kategori</option>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['id_kategori'] ?>">
                    <?= $k['nama_kategori'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <!-- 📚 LIST BUKU -->
    <div id="listBuku" class="grid-buku">

        <?php foreach ($buku as $b): ?>
            <div class="card-buku"
                data-judul="<?= strtolower($b['judul']) ?>"
                data-kategori="<?= $b['id_kategori'] ?>">

                <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>">

                <div class="judul"><?= $b['judul'] ?></div>

                <!-- radio hidden -->
                <input type="radio" name="id_buku" value="<?= $b['id_buku'] ?>" hidden>

                <div class="aksi">
                    <button type="button" onclick="pilihBuku(this)">📥 Pinjam</button>
                    <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>">🔍</a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <br><br>

    <!-- 👤 PETUGAS -->
    <label>Petugas</label><br>
    <select name="id_petugas" required>
        <?php foreach ($petugas as $p): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <!-- 🚚 METODE -->
    <label>Metode Pengambilan</label><br>
    <select name="metode" id="metode" onchange="toggleAlamat()">
        <option value="ambil">Ambil Langsung</option>
        <option value="antar">Diantar</option>
    </select>

    <br><br>

    <!-- 📍 ALAMAT -->
    <div id="alamatBox" style="display:none;">
        <label>Alamat</label><br>
        <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>
    </div>

    <br>

    <button type="submit">Simpan</button>

</form>

<!-- 🔥 SCRIPT -->
<script>
    // pilih buku
    function pilihBuku(btn) {
        document.querySelectorAll('.card-buku').forEach(c => c.classList.remove('active'));

        let card = btn.closest('.card-buku');
        card.classList.add('active');

        card.querySelector('input').checked = true;
    }

    // filter buku
    function filterBuku() {
        let search = document.getElementById("search").value.toLowerCase();
        let kategori = document.getElementById("kategori").value;

        document.querySelectorAll(".card-buku").forEach(function(b) {
            let judul = b.dataset.judul;
            let kat = b.dataset.kategori;

            let cocok = judul.includes(search) && (kategori === "" || kat === kategori);

            b.style.display = cocok ? "block" : "none";
        });
    }

    // alamat muncul
    function toggleAlamat() {
        let metode = document.getElementById("metode").value;
        document.getElementById("alamatBox").style.display = (metode === 'antar') ? 'block' : 'none';
    }
</script>

<!-- 🎨 STYLE -->
<style>
    .grid-buku {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .card-buku {
        width: 150px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        transition: 0.2s;
    }

    .card-buku img {
        width: 100px;
        height: 140px;
        object-fit: cover;
    }

    .card-buku:hover {
        transform: scale(1.05);
    }

    .card-buku.active {
        border: 2px solid green;
    }

    .judul {
        font-size: 13px;
        margin: 5px 0;
    }

    .aksi {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
    }

    button {
        cursor: pointer;
    }
</style>

<?= $this->endSection() ?>