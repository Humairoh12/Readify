<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <!-- CSS TAMBAHAN KHUSUS LOGIN -->
    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            font-family: 'Poppins', sans-serif;
        }

        .login-box {
            width: 380px;
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .login-title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
        }

        .btn-login:hover {
            transform: scale(1.02);
            transition: 0.2s;
        }

        .link-btns a {
            margin: 3px;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100">

        <div class="login-box">

            <h4 class="login-title">🔐 Readify</h4>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('salahpw')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('salahpw') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/proses-login') ?>" method="post">

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100 btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </button>

            </form>

            <div class="text-center mt-3 link-btns">
                <a href="<?= base_url('users/create') ?>" class="btn btn-outline-success btn-sm">
                    ➕ Daftar
                </a>

                <a href="<?= base_url('restore') ?>" class="btn btn-outline-danger btn-sm">
                    ♻ Restore
                </a>
            </div>

        </div>

    </div>

</body>

</html>