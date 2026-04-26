<style>
    /* PROFILE */
    .menu-wrapper img {
        object-fit: cover;
        border: 2px solid #fff;
    }

    /* NAV ITEM SPACING */
    .nav-item {
        margin-bottom: 5px;
    }

    /* ICON */
    .nav-link i {
        margin-right: 8px;
    }

    /* ACTIVE ANIMATION */
    .nav-link {
        transition: 0.2s;
    }

    .nav-link:hover {
        transform: translateX(5px);
    }
</style>

<div class="menu-wrapper">

    <!-- Profile -->
    <div class="text-center mb-4">
        <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>"
            class="rounded-circle mb-2" width="70" height="70">
        <h6 class="mb-0"><?= session('nama'); ?></h6>
        <small class="text-muted"><?= session('role'); ?></small>
    </div>

    <!-- Menu -->
    <ul class="nav flex-column">

        <li class="nav-item">
            <a class="nav-link <?= uri_string() == '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </li>

        <?php if (session()->get('role') == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link <?= strpos(uri_string(), 'users') !== false ? 'active' : '' ?>" href="<?= base_url('users') ?>">
                    <i class="bi bi-people"></i> Users
                </a>
            </li>
        <?php endif; ?>

        <?php if (in_array(session()->get('role'), ['admin', 'petugas', 'anggota'])): ?>
            <li class="nav-item">
                <a class="nav-link <?= strpos(uri_string(), 'buku') !== false ? 'active' : '' ?>" href="<?= base_url('buku') ?>">
                    <i class="bi bi-book"></i> Buku
                </a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'anggota'): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('anggota/profil') ?>">
                    <i class="bi bi-person"></i> Profil
                </a>
            </li>
        <?php endif; ?>

        <?php if (in_array(session()->get('role'), ['admin', 'petugas', 'anggota'])): ?>
            <li class="nav-item">
                <a class="nav-link <?= strpos(uri_string(), 'peminjaman') !== false ? 'active' : '' ?>" href="<?= base_url('peminjaman') ?>">
                    <i class="bi bi-box-arrow-in-down"></i> Peminjaman
                </a>
            </li>
        <?php endif; ?>

        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])): ?>
            <li class="nav-item">
                <a class="nav-link <?= strpos(uri_string(), 'pengembalian') !== false ? 'active' : '' ?>" href="<?= base_url('pengembalian') ?>">
                    <i class="bi bi-box-arrow-up"></i> Pengembalian
                </a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kategori') ?>">
                    <i class="bi bi-tags"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('penulis') ?>">
                    <i class="bi bi-pencil"></i> Penulis
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('penerbit') ?>">
                    <i class="bi bi-building"></i> Penerbit
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('rak') ?>">
                    <i class="bi bi-archive"></i> Rak
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link <?= strpos(uri_string(), 'denda') !== false ? 'active' : '' ?>" href="<?= base_url('denda') ?>">
                <i class="bi bi-cash"></i> Denda
            </a>
        </li>

        <li class="nav-item mt-3">
            <a class="nav-link" href="<?= base_url('users/edit/' . session('id')) ?>">
                <i class="bi bi-gear"></i> Setting
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-danger" href="<?= base_url('logout') ?>">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>

    </ul>

    <!-- Backup Button -->
    <?php if (session()->get('role') == 'admin') : ?>
        <div class="mt-3">
            <a href="<?= base_url('/backup') ?>" class="btn btn-success w-100">
                Backup Database
            </a>
        </div>
    <?php endif; ?>

</div>