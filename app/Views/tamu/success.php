<!doctype html>
<html lang="en">

<base href="<?= base_url('assets') ?>/">

<head>
    <meta charset="utf-8">
    <title>Registrasi Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <link rel="icon" type="image/png" href="dist/assets/img/logo.png">
</head>

<body class="login-page bg-body-secondary">

    <div class="login-box">
        <div class="card shadow">
            <div class="card-body login-card-body text-center">

                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 60px;"></i>
                </div>

                <h4 class="fw-bold text-success">Registrasi Berhasil</h4>

                <p class="text-muted mt-2">
                    Terima kasih, data kunjungan Anda telah berhasil disimpan.
                </p>

                <hr>

                <p class="mb-1">Nomor Tiket Kunjungan Anda</p>
                <div class="alert alert-success fw-bold fs-4">
                    <?= esc($nomor_tiket) ?>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <a href="<?= base_url('tamu/exportPDF/' . $tamu_id) ?>"
                        class="btn btn-primary btn-lg">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                        Download PDF
                    </a>
                </div>

                <div class="mt-3">
                    <small class="text-muted">
                        Simpan tiket ini dan tunjukkan saat kunjungan.
                    </small>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE -->
    <script src="dist/js/adminlte.js"></script>

</body>

</html>