<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Akses Restore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            font-family: 'Poppins', sans-serif;
        }

        .auth-box {
            width: 380px;
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .title {
            font-weight: 600;
            text-align: center;
        }

        .icon {
            font-size: 45px;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-custom {
            border-radius: 10px;
            padding: 10px;
        }

        .btn-custom:hover {
            transform: scale(1.02);
            transition: 0.2s;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100">

        <div class="auth-box">

            <div class="icon">🔐</div>

            <h4 class="title mt-2">Akses Restore Database</h4>
            <p class="text-muted text-center small">Masukkan password untuk melanjutkan</p>

            <!-- ERROR -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('restore/auth') ?>" method="post">

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" onclick="togglePassword()">
                    <label class="form-check-label">Tampilkan Password</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-custom">
                    Masuk
                </button>

            </form>

        </div>

    </div>

    <script>
        function togglePassword() {
            let x = document.getElementById("password");
            x.type = (x.type === "password") ? "text" : "password";
        }
    </script>

</body>

</html>