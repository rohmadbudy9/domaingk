<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Kunjungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <h2>Dashboard Rekap Kunjungan</h2>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5>Total Kunjungan</h5>
                    <h2><?= $totalTamu ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5>Kunjungan Hari Ini</h5>
                    <h2><?= $totalHariIni ?></h2>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-4">Rekap Lokasi Data Center</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Lokasi DC</th>
                <th>Total Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rekapLokasi as $r): ?>
                <tr>
                    <td><?= esc($r['lokasi_dc']) ?></td>
                    <td><?= esc($r['total']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="mt-4">Kunjungan Terbaru</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nomor Tiket</th>
                <th>Nama</th>
                <th>Lokasi DC</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($latestTamu as $t): ?>
                <tr>
                    <td><?= esc($t['nomor_tiket']) ?></td>
                    <td><?= esc($t['nama']) ?></td>
                    <td><?= esc($t['lokasi_dc']) ?></td>
                    <td><?= esc($t['tanggal_kedatangan']) ?></td>
                    <td>
                        <a class="btn btn-sm btn-outline-primary"
                            href="<?= base_url('tamu/exportPDF/' . $t['id']) ?>">
                            PDF
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>