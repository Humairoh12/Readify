<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Readify</title>

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <!-- CSS GABUNGAN -->
    <style>
        /* FONT & BACKGROUND */
        body {
            font-family: "Poppins", "SF Pro", sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #dfe9f3, #ffffff);
            display: flex;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            min-height: 100vh;
            padding: 20px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            border-radius: 0 20px 20px 0;
        }

        .sidebar h5 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            color: #555;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 8px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #e3f2fd;
            color: #0d6efd;
        }

        /* CONTENT */
        .content {
            flex-grow: 1;
            padding: 25px;
        }

        /* GLASS CARD */
        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }

        /* TEXT */
        h3 {
            font-weight: bold;
        }

        /* SCROLL HALUS */
        ::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>