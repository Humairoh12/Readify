<!DOCTYPE html>
<html>

<head>
    <title>Print Data Rak</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #0d6efd;
            color: white;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Data Rak</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Rak</th>
                <th>Lokasi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;
            foreach ($rak as $r): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['nama_rak'] ?? '-' ?></td>
                    <td><?= $r['lokasi'] ?? '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>