<!DOCTYPE html>
<html>

<head>
    <title>Laporan Status Domain</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h3>Laporan Monitoring Domain</h3>
    <p>Tanggal: <?= esc($selected_date) ?> | Kategori: <?= esc($selected_kategori ?: 'Semua') ?></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama OPD</th>
                <th>Alamat Web</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Diperiksa Oleh</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($checks as $c): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($c['nama_opd']) ?></td>
                    <td><?= esc($c['alamat_web']) ?></td>
                    <td><?= esc($c['kategori']) ?></td>
                    <td><?= esc($c['status']) ?></td>
                    <td><?= esc($c['note']) ?></td>
                    <td><?= esc($c['checked_by']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>