<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard Kunjungan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Kunjungan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Statistik -->
            <div class="row mb-4">

                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5>Total Kunjungan</h5>
                            <h2><?= $totalTamu ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5>Kunjungan Hari Ini</h5>
                            <h2><?= $totalHariIni ?></h2>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Rekap Lokasi DC -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Rekap Lokasi Data Center</h5>
                        </div>
                        <div class="card-body">
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
                        </div>
                    </div>
                </div>

                <!-- Kunjungan Terbaru -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Kunjungan Terbaru</h5>
                        </div>
                        <div class="card-body">
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
                                        <tr class="align-middle">
                                            <td><?= esc($t['nomor_tiket']) ?></td>
                                            <td><?= esc($t['nama']) ?></td>
                                            <td><?= esc($t['lokasi_dc']) ?></td>
                                            <td><?= esc($t['tanggal_kedatangan']) ?></td>
                                            <td>
                                                <a href="<?= base_url('tamu/exportPDF/' . $t['id']) ?>"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-file-earmark-pdf"></i> PDF
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Row-->

        </div>
    </div>
    <!--end::App Content-->

</main>
<!--end::App Main-->

<?= $this->endSection() ?>