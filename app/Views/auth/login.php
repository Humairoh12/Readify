<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Readify</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* CONTAINER */
        .login-container {
            width: 900px;
            height: 500px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(25px);
            border-radius: 20px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* LEFT SIDE */
        .left-side {
            width: 50%;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        .logo-box {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-box img {
            width: 75%;
            height: auto;
            object-fit: contain;
            transition: 0.3s;
        }

        .logo-box img:hover {
            transform: scale(1.05);
        }

        /* RIGHT SIDE */
        .right-side {
            width: 50%;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
        }

        .login-title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 25px;
            color: #475569;
        }

        .form-control {
            border-radius: 12px;
            padding: 10px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: #bfdbfe;
            box-shadow: 0 0 5px rgba(191, 219, 254, 0.5);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .btn-login {
            width: 100%;
            border-radius: 12px;
            padding: 10px;
            background: linear-gradient(135deg, #bfdbfe, #dbeafe);
            border: none;
            color: #334155;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-login:hover {
            transform: scale(1.03);
            background: linear-gradient(135deg, #93c5fd, #bfdbfe);
        }

        .link-btns {
            text-align: center;
            margin-top: 15px;
        }

        .link-btns a {
            font-size: 13px;
            margin: 3px;
        }

        /* RESPONSIVE */
        @media(max-width:768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
                height: auto;
            }

            .left-side,
            .right-side {
                width: 100%;
                height: auto;
            }

            .logo-box img {
                width: 50%;
                margin: 20px 0;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <!-- KIRI (LOGO CENTER PERFECT) -->
        <div class="left-side">
            <div class="logo-box">
                <!-- ⚠️ PASTIKAN FILE BENAR -->
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Readify">
            </div>
        </div>

        <!-- KANAN (FORM LOGIN) -->
        <div class="right-side"><br><br>

            <h4 class="login-title">🔐 Login</h4>

            <!-- ERROR -->
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

            <!-- FORM -->
            <form action="<?= base_url('/proses-login') ?>" method="post">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </button>

            </form>

            <!-- LINK -->
            <div class="link-btns">
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