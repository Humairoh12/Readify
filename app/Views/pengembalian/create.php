<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Form Pengembalian</h3>

<form action="<?= base_url('pengembalian/store') ?>" method="post">

    <label>Peminjaman</label><br>
    <select name="id_peminjaman">
        <?php foreach ($peminjaman as $p): ?>
            <option value="<?= $p['id_peminjaman'] ?>">
                ID <?= $p['id_peminjaman'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tanggal Dikembalikan</label><br>
    <input type="date" name="tanggal_dikembalikan"><br><br>
    <label>Denda</label><br>
    <input type="number" name="denda" id="denda" value="0"><br><br>

    <button type="submit">Simpan</button>

</form>

<?= $this->endSection() ?>t