<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Report Cek Domain </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report Cek Domain</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <?php if (session()->getFlashdata('success')): ?>
                    <p style="color: green;"><?= session()->getFlashdata('success'); ?></p>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <p style="color: red;"><?= session()->getFlashdata('error'); ?></p>
                <?php endif; ?>
                <div class="col-md-11">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="get" action="<?= base_url('/report') ?>" class="mb-3">
                                <label>Kategori:</label>
                                <select name="kategori" class="form-control" style="max-width: 250px; display: inline-block;">
                                    <option value="">-- Semua Kategori --</option>
                                    <?php foreach ($kategori_list as $kat): ?>
                                        <option value=" <?= esc($kat['kategori']) ?>" <?= $selected_kategori == $kat['kategori'] ? 'selected' : '' ?>>
                                            <?= esc($kat['kategori']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="date">Pilih Tanggal:</label>
                                <input type="date" id="date" name="date" value="<?= esc($selected_date) ?>" class="form-control" style="max-width: 250px; display: inline-block;">
                                <button type="submit" class="btn btn-secondary">Tampilkan</button>
                                <!-- Tombol Export dengan Dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-download"></i> Export
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-danger"
                                                href="<?= base_url('/report/exportPDF?date=' . $selected_date . '&kategori=' . $selected_kategori) ?>"
                                                target="_blank">
                                                <i class="fas fa-file-pdf"></i> Export PDF
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-success"
                                                href="<?= base_url('/report/exportExcel?date=' . $selected_date . '&kategori=' . $selected_kategori) ?>">
                                                <i class="fas fa-file-excel"></i> Export Excel
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </form>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Nama OPD</th>
                                        <th>Alamat Website</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Dicek Oleh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($checks)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada data pengecekan.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($checks as $check): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= esc($check['nama_opd']) ?></td>
                                                <td><?= esc($check['alamat_web']) ?></td>
                                                <td><?= $check['status'] === 'up' ? '🟢 Up' : '🔴 Down' ?></td>
                                                <td><?= esc($check['note']) ?></td>
                                                <td><?= esc($check['checked_by']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- <div class="mt-3">
                                <a href="<?= base_url('checklist/export/excel?date=' . $selected_date . '&kategori=' . $selected_kategori) ?>" class="btn btn-success">
                                    Export Excel
                                </a>
                                <a href="<?= base_url('checklist/export/pdf?date=' . $selected_date . '&kategori=' . $selected_kategori) ?>" class="btn btn-danger" target="_blank">
                                    Export PDF
                                </a>
                            </div> -->

                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
<?= $this->endSection() ?>