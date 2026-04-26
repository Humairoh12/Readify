<!DOCTYPE html>
<html>

<head>
    <title>Print Denda</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-print {
            width: 100%;
            border-collapse: collapse;
        }

        .table-print th,
        .table-print td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .table-print th {
            background: #eee;
        }

        .text-danger {
            color: red;
            font-weight: bold;
        }

        .text-success {
            color: green;
            font-weight: bold;
        }

        .text-warning {
            color: orange;
            font-weight: bold;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Data Denda</h2>

    <table class="table-print">
        <tr>
            <th>No</th>
            <th>ID Peminjaman</th>
            <th>Jumlah Denda</th>
            <th>Status</th>
            <th>Metode</th>
        </tr>

        <?php $no = 1;
        foreach ($denda as $d): ?>

            <?php
            $status = $d['status_denda'] ?? '-';
            ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['id_peminjaman'] ?? '-' ?></td>

                <!-- JUMLAH -->
                <td class="<?= ($d['jumlah_denda'] ?? 0) > 0 ? 'text-danger' : '' ?>">
                    Rp <?= number_format($d['jumlah_denda'] ?? 0, 0, ',', '.') ?>
                </td>

                <!-- STATUS -->
                <td>
                    <?php if ($status == 'belum bayar'): ?>
                        <span class="text-danger">Belum Bayar</span>

                    <?php elseif ($status == 'menunggu verifikasi'): ?>
                        <span class="text-warning">Menunggu</span>

                    <?php elseif ($status == 'lunas'): ?>
                        <span class="text-success">Lunas</span>

                    <?php elseif ($status == 'ditolak'): ?>
                        <span class="text-danger">Ditolak</span>

                    <?php else: ?>
                        <?= $status ?>
                    <?php endif; ?>
                </td>

                <!-- METODE -->
                <td>
                    <?= $d['metode_pembayaran']
                        ? strtoupper($d['metode_pembayaran'])
                        : '-' ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>