<a href="#"><b>📚 Readify</b>App</a><br>

<a href="<?= base_url('/') ?>">🏠 Dashboard</a><br>

<?php if (session()->get('role') == 'admin'): ?>
    <a href="<?= base_url('users') ?>">👤 Users</a><br>
<?php endif; ?>

<?php if (in_array(session()->get('role'), ['admin', 'petugas', 'anggota'])): ?>
    <a href="<?= base_url('buku') ?>">📖 Data Buku</a><br>
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

<a href="<?= base_url('users/edit/' . session('id')) ?>">⚙️ Setting</a><br>
<a href="<?= base_url('logout') ?>">🚪 Logout</a><br>

Masuk sebagai: <b><?= session('nama'); ?> (<?= session('role'); ?>)</b><br><br>

<img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80" />