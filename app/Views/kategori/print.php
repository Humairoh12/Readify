<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Print Data Kategori</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #f2f2f2;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>

</head>

<body onload="window.print()">

    <h2>Data Kategori</h2>

    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($kategori)): ?>
                <?php $no = 1;
                foreach ($kategori as $k): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $k['nama_kategori'] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>

    <!-- 🔹 FOOTER -->
    <div class="footer">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </div>

</body>

</html>