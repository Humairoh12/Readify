<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Background gradient lembut */
    body {
        background: linear-gradient(135deg, #dfe9f3, #ffffff);
        font-family: 'Poppins', sans-serif;
    }

    /* Wrapper */
    .dashboard-wrapper {
        padding: 20px;
    }

    /* Sidebar */
    .sidebar {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        height: 100vh;
    }

    .sidebar .nav-link {
        color: #555;
        border-radius: 10px;
        padding: 10px;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background: #e3f2fd;
        color: #0d6efd;
    }

    /* Glass Card Effect */
    .glass-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    /* Card hover biar hidup */
    .glass-card:hover {
        transform: translateY(-5px);
        transition: 0.3s;
    }

    /* Responsive spacing */
    h3 {
        font-weight: bold;
    }
</style>

<div class="dashboard-wrapper">
    <div class="container-fluid">
        <div class="row">

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">

                <div class="glass-card p-4 mb-4">
                    <h4>Dashboard</h4>
                    <p>Selamat datang di <b>Readify App</b> 👋</p>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="glass-card p-3">
                            <h6>Total Buku</h6>
                            <h3>120</h3>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card p-3">
                            <h6>Total Anggota</h6>
                            <h3>80</h3>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card p-3">
                            <h6>Peminjaman</h6>
                            <h3>45</h3>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>