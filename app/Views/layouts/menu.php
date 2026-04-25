<a href="#"><b>📚 Readify</b>App</a><br>

<a href="<?= base_url('/') ?>">🏠 Dashboard</a><br>

<?php if (session()->get('role') == 'admin'): ?>
    <a href="<?= base_url('users') ?>">👤 Users</a><br>
<?php endif; ?>

<?php if (in_array(session()->get('role'), ['admin', 'petugas', 'anggota'])): ?>
    <a href="<?= base_url('buku') ?>">📖 Buku</a><br>
<?php endif; ?>

<?php if (session()->get('role') == 'anggota'): ?>
    <a href="<?= base_url('anggota/profil') ?>">👤 Lihat Profil</a><br>
<?php endif; ?>
<?php if (in_array(session()->get('role'), ['admin', 'petugas', 'anggota'])): ?>
    <a href="<?= base_url('peminjaman') ?>">📥 Peminjaman</a><br>
<?php endif; ?>

<?php if (in_array(session()->get('role'), ['admin', 'petugas'])): ?>
    <a href="<?= base_url('pengembalian') ?>">📤 Pengembalian</a><br>
<?php endif; ?>

<?php if (session()->get('role') == 'admin'): ?>
    <a href="<?= base_url('kategori') ?>">🏷️ Kategori</a><br>
    <a href="<?= base_url('penulis') ?>">✍️ Penulis</a><br>
    <a href="<?= base_url('penerbit') ?>">🏢 Penerbit</a><br>
    <a href="<?= base_url('rak') ?>">🗄️ Rak</a><br>
<?php endif; ?>
<li class="<?= strpos(uri_string(), 'denda') !== false ? 'active' : '' ?>">
    <a href="<?= base_url('denda') ?>">💰 Denda</a>
</li>

<a href="<?= base_url('users/edit/' . session('id')) ?>">⚙️ Setting</a><br>
<a href="<?= base_url('logout') ?>">🚪 Logout</a><br>
<?php if (session()->get('role') == 'admin') : ?>
    <a href="<?= base_url('/backup') ?>" class="btn btn-success">Backup Database</a>
<?php endif; ?>
Masuk sebagai: <b><?= session('nama'); ?> (<?= session('role'); ?>)</b><br><br>

<img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80" />