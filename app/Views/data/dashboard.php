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
          <!-- <h3 class="mb-0">Cek Domain Kabupaten Gunungkidul v2</h3> -->
          <h1><strong>Cek Domain</strong></h1>
          <h2>Kabupaten Gunungkidul</h2>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard /</a></li>

          </ol>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <?php if (session()->getFlashdata('success')): ?>
          <p style="color: green;"><?= session()->getFlashdata('success'); ?></p>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
          <p style="color: red;"><?= session()->getFlashdata('error'); ?></p>
        <?php endif; ?>

        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('dashboard/kategori/OPD') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon text-bg-primary shadow-sm">
                <i class="bi bi-bank"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">OPD</span>
                <span class="info-box-number"><?= $count_opd ?> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('dashboard/kategori/Kapanewon') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon text-bg-danger shadow-sm">
                <i class="bi bi-building-fill"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Kapanewon</span>
                <span class="info-box-number"><?= $count_kapanewon ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <!-- <div class="clearfix hidden-md-up"></div> -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="https://desa.gunungkidulkab.go.id/perkakas/artikel/" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon text-bg-success shadow-sm">
                <i class="bi bi-buildings-fill"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Kalurahan</span>
                <span class="info-box-number">144</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('dashboard/kategori/puskeswan') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon bg-white shadow-sm">
                <i class="bi bi-prescription2"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Puskeswan</span>
                <span class="info-box-number"><?= $count_puskeswan ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('dashboard/kategori/puskesmas') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon text-bg-light shadow-sm">
                <i class="bi bi-hospital-fill"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Puskesmas</span>
                <span class="info-box-number"><?= $count_puskesmas ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('dashboard/kategori/bpp') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon text-bg-secondary shadow-sm">
                <i class="bi bi-flower3"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">BPP</span>
                <span class="info-box-number"><?= $count_bpp ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="https://monitorweb.pendidikan.gunungkidulkab.go.id/" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon text-bg-info shadow-sm">
                <i class="bi bi-book-fill"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Pendidikan</span>
                <span class="info-box-number">1,917 </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('dashboard/kategori/ikm') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon text-bg-warning shadow-sm">
                <i class="bi bi-cash-coin"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">IKM</span>
                <span class="info-box-number"><?= $count_ikm ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('dashboard/kategori/other') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon text-bg-dark shadow-sm">
                <i class="bi bi-people-fill"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Other</span>
                <span class="info-box-number"><?= $count_other ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('dashboard/kategori/cekslot') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon bg-transparent shadow-sm">
                <i class="bi bi-hdd-rack"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Cek Slot </span>
                <span class="info-box-number"><?= $count_cekslot ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= base_url('/ping-page') ?>" class="nav-link">
            <div class="info-box">
              <span class="info-box-icon bg-transparent shadow-sm">
                <i class="bi bi-wifi"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Ping </span>
                <span class="info-box-number"><?= $count_ping ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>

        <!-- /.col -->


      </div>
      <!-- /.row -->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->
<?= $this->endSection() ?>