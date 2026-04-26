<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Restore Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            font-family: 'Poppins', sans-serif;
        }

        .auth-box {
            width: 450px;
            background: #fff;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .title {
            font-weight: 600;
            text-align: center;
        }

        .btn-custom {
            border-radius: 10px;
            padding: 10px;
        }

        .btn-custom:hover {
            transform: scale(1.02);
            transition: 0.2s;
        }

        .alert-warning {
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100">

        <div class="auth-box">

            <h4 class="title text-danger">⚠ Restore Database</h4>

            <!-- ERROR -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- SUCCESS -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success text-center">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="alert alert-warning small">
                <b>Peringatan!</b><br>
                Restore akan menimpa seluruh data database.<br>
                Pastikan backup sudah aman.
            </div>

            <form action="<?= base_url('restore/process') ?>" method="post"
                enctype="multipart/form-data"
                onsubmit="return confirm('Yakin ingin restore database?')">

                <div class="mb-3">
                    <label class="form-label">Upload File SQL</label>
                    <input type="file" name="file_sql" class="form-control" accept=".sql" required>
                </div>

                <button type="submit" class="btn btn-danger w-100 btn-custom">
                    🔄 Restore Database
                </button>

                <a href="<?= base_url('/') ?>" class="btn btn-secondary w-100 mt-2 btn-custom">
                    ← Kembali
                </a>

            </form>

        </div>

    </div>

</body>

</html>