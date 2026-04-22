<!DOCTYPE html>
<html>

<head>
    <title>Print Buku</title>
</head>

<body onload="window.print()">

    <h2>Data Buku</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>ISBN</th>
            <th>Tahun</th>
        </tr>

        <?php $no = 1;
        foreach ($buku as $b): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $b['judul'] ?></td>
                <td><?= $b['isbn'] ?></td>
                <td><?= $b['tahun_terbit'] ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>

</html>