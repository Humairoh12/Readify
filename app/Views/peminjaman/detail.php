<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Detail Peminjaman</h3>

<table border="1" cellpadding="5">
    <tr>
        <td>Anggota</td>
        <td><?= $peminjaman['nama_anggota'] ?></td>
    </tr>
    <tr>
        <td>Petugas</td>
        <td><?= $peminjaman['nama_petugas'] ?></td>
    </tr>
    <tr>
        <td>Tanggal Pinjam</td>
        <td><?= $peminjaman['tanggal_pinjam'] ?></td>
    </tr>
    <tr>
        <td>Tanggal Kembali</td>
        <td><?= $peminjaman['tanggal_kembali'] ?? '-' ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?= $peminjaman['status'] ?></td>
    </tr>
</table>

<br>
<a href="<?= base_url('peminjaman') ?>">Kembali</a>

<?= $this->endSection() ?>