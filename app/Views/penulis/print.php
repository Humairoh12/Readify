<!DOCTYPE html>
<html>

<head>
    <title>Print Data Penulis</title>

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

        /* PRINT ONLY */
        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Data Penulis</h2>

    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Nama Penulis</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($penulis)): ?>
                <?php $no = 1;
                foreach ($penulis as $p): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $p['nama_penulis'] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>