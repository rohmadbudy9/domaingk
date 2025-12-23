<!doctype html>
<html lang="en">

<base href="<?= base_url('assets') ?>/">

<head>
    <meta charset="utf-8">
    <title>Review Data Kunjungan</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.css">
</head>

<body class="login-page bg-body-secondary">

    <div class="login-box" style="width: 90%; max-width: 1100px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h4 class="mb-0">
                    <i class="bi bi-eye-fill"></i> Review Data Kunjungan
                </h4>
            </div>

            <div class="card-body">

                <!-- Informasi Utama -->
                <h5 class="mb-3">Informasi Tamu</h5>

                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th width="30%">Lokasi Data Center</th>
                            <td><?= esc($form['lokasi_dc']) ?></td>
                        </tr>
                        <tr>
                            <th>Kategori Keperluan</th>
                            <td><?= esc($form['kategori_keperluan']) ?></td>
                        </tr>
                        <tr>
                            <th>Keperluan</th>
                            <td><?= esc($form['keperluan']) ?></td>
                        </tr>
                        <tr>
                            <th>Nama Tamu</th>
                            <td><?= esc($form['nama']) ?></td>
                        </tr>
                        <tr>
                            <th>Asal</th>
                            <td><?= esc($form['asal']) ?></td>
                        </tr>
                        <tr>
                            <th>No HP / WA</th>
                            <td><?= esc($form['nomor_hp']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= esc($form['email']) ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Orang</th>
                            <td><?= esc($form['jumlah']) ?></td>
                        </tr>
                        <tr>
                            <th>Aktivitas</th>
                            <td><?= esc($form['aktivitas']) ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Kedatangan</th>
                            <td><?= esc($form['tanggal_kedatangan']) ?></td>
                        </tr>
                        <tr>
                            <th>Waktu Kedatangan</th>
                            <td><?= esc($form['waktu_kedatangan']) ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Personel Tambahan -->
                <?php if (!empty($personel)): ?>
                    <h5 class="mt-4">Personel Tambahan</h5>

                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($personel as $i => $p): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($p['nama']) ?></td>
                                    <td><?= esc($p['nomor_hp']) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <!-- Lampiran -->
                <h5 class="mt-4">Lampiran Foto</h5>

                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Foto Diri</th>
                            <th>Foto KTP / ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="<?= base_url($foto_diri) ?>" class="img-thumbnail" style="max-height:180px">
                            </td>
                            <td>
                                <img src="<?= base_url($foto_ktp) ?>" class="img-thumbnail" style="max-height:180px">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Action -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= base_url('tamu') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali Edit
                    </a>

                    <form action="<?= base_url('tamu/submitFinal') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle-fill"></i> Submit Final
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.js"></script>

</body>

</html>