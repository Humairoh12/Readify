<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Print Data Pengembalian</title>

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

        .text-danger {
            color: red;
        }

        .text-success {
            color: green;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>

</head>

<body onload="window.print()">

    <h2>Data Pengembalian</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Peminjaman</th>
                <th>Tanggal Dikembalikan</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($pengembalian)): ?>
                <?php $no = 1;
                foreach ($pengembalian as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>#<?= $p['id_peminjaman'] ?></td>
                        <td><?= $p['tanggal_dikembalikan'] ?></td>

                        <td class="<?= ($p['denda'] ?? 0) > 0 ? 'text-danger' : 'text-success' ?>">
                            Rp <?= number_format($p['denda'] ?? 0, 0, ',', '.') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada data</td>
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