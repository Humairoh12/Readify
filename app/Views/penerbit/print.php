<!DOCTYPE html>
<html>

<head>
    <title>Print Data Penerbit</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            text-align: right;
            font-size: 12px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 10px;
            font-size: 14px;
        }

        table th {
            background: #f2f2f2;
            text-align: center;
        }

        table td {
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        /* PRINT MODE */
        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Data Penerbit</h2>

    <div class="info">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </div>

    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Nama Penerbit</th>
                <th>Alamat</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($penerbit)): ?>
                <?php $no = 1;
                foreach ($penerbit as $p): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $p['nama_penerbit'] ?? '-' ?></td>
                        <td><?= $p['alamat'] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>

</body>

</html>