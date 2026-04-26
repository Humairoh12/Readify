<!DOCTYPE html>
<html>

<head>
    <title>Print Data Buku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .header {
            margin-bottom: 20px;
        }

        .header small {
            display: block;
            text-align: right;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        tr:nth-child(even) {
            background: #fafafa;
        }

        /* PRINT SETTING */
        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <h2>Data Buku </h2>
        <small>Tanggal: <?= date('d-m-Y') ?></small>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Judul</th>
                <th>ISBN</th>
                <th width="15%">Tahun</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($buku)): ?>
                <?php $no = 1;
                foreach ($buku as $b): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $b['judul'] ?></td>
                        <td><?= $b['isbn'] ?></td>
                        <td><?= $b['tahun_terbit'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>