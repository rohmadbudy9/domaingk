<!doctype html>
<html lang="en">
<!--begin::Head-->

<base href="<?php echo base_url('assets') ?>/">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="ColorlibHQ" />
  <!--end::Primary Meta Tags-->
  <!--begin::Fonts-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
    crossorigin="anonymous" />
  <!--end::Fonts-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->
  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="dist/css/adminlte.css" />
  <link rel="icon" type="image/png" href="dist/assets/img/logo.png">
  <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary">
  <div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Selamat Datang!</p>
        <h6 class="mb-0">Mohon mengisi formulir di bawah ini jika anda ingin melanjutkan pengalaman berkunjung anda. Kolom dengan tanda (*) wajib diisi. </h6><br>
        <?php if ($error = session()->getFlashdata('error')): ?>
          <?php if (is_array($error)): ?>
            <div style="color: red;">
              <ul>
                <?php foreach ($error as $e): ?>
                  <li><?= esc($e) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php else: ?>
            <p style="color: red;"><?= esc($error) ?></p>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
          <p style="color: green;"><?= session()->getFlashdata('success'); ?></p>
        <?php endif; ?>
        <form action="<?= base_url('tamu/insert'); ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <!-- Lokasi Data Center -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Lokasi Data Center<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-hdd-network"></i></span>
            <select name="lokasi_dc" class="form-control" required>
              <option value="" disabled selected>-- Pilih Lokasi --</option>
              <option value="Server Data Center">Server Data Center</option>
              <option value="Network Data Center">Network Data Center</option>
            </select>
          </div>

          <!-- Kategori Keperluan -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Kategori Keperluan<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-list-check"></i></span>
            <select name="kategori_keperluan" class="form-control" required>
              <option value="" disabled selected>-- Pilih Kategori --</option>
              <option value="Data Center">Data Center</option>
              <option value="Non Data Center">Non Data Center</option>
            </select>
          </div>

          <!-- Keperluan -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Keperluan<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-info-circle"></i></span>
            <select name="keperluan" class="form-control" required>
              <option value="" disabled selected>-- Pilih Keperluan --</option>
              <option value="Survey">Survey</option>
              <option value="Meeting">Meeting</option>
              <option value="Interview">Interview</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <!-- Nama -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Nama Tamu<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required />
          </div>

          <!-- Asal -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Asal Tamu<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
            <input type="text" name="asal" class="form-control" placeholder="Asal Instansi / Daerah" required />
          </div>

          <!-- Nomor HP -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Nomor Telepon / WA<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
            <input type="tel" name="nomor_hp" class="form-control" placeholder="Nomor HP" required />
          </div>

          <!-- Email -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Email<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Alamat Email" required />
          </div>

          <!-- Jumlah Orang -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Jumlah Orang<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1" required>
          </div>

          <!-- Tempat dynamic form muncul -->
          <div id="personel-form"></div>

          <!-- Aktivitas -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Aktivitas<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-clipboard-check"></i></span>
            <textarea name="aktivitas" class="form-control" placeholder="Aktivitas Selama di Tempat" rows="2"></textarea>
          </div>

          <!-- Foto Diri -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Foto Diri<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-person-bounding-box"></i></span>
            <input type="file" name="foto_diri" class="form-control" accept="image/*" required />
          </div>

          <!-- Foto KTP -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Kartu ID / KTP / Paspor<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-card-image"></i></span>
            <input type="file" name="foto_ktp" class="form-control" accept="image/*" required />
          </div>

          <!-- Tanggal -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Tanggal Kedatangan<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            <input type="date" name="tanggal_kedatangan" class="form-control" required />
          </div>

          <!-- Waktu -->
          <div class="input-group mb-3">
            <label class="form-label col-3 col-form-label">Waktu Kedatangan<span style="color:red">*</span></label>
            <span class="input-group-text"><i class="bi bi-clock-fill"></i></span>
            <input type="time" name="waktu_kedatangan" class="form-control" required />
          </div>

          <!-- Tombol Submit -->
          <div class="row">
            <div class="col-4">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-send-fill"></i> Kirim
                </button>
              </div>
            </div>
          </div>
        </form>
        <!--end::Row-->
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
  </div>
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
    crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="dist/js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>
  <script>
    document.getElementById('jumlah').addEventListener('input', function() {
      const jumlah = parseInt(this.value);
      const container = document.getElementById('personel-form');
      container.innerHTML = ""; // reset

      if (jumlah > 1) {
        let html = `
                <br>
                <h5>Data Personel Tambahan</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Personel</th>
                            <th>Nomor HP</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

        for (let i = 2; i <= jumlah; i++) {
          html += `
                    <tr>
                        <td>${i - 1}</td>
                        <td><input type="text" name="personel_nama[]" class="form-control" required></td>
                        <td><input type="text" name="personel_hp[]" class="form-control" required></td>
                    </tr>
                `;
        }

        html += `
                    </tbody>
                </table>
            `;

        container.innerHTML = html;
      }
    });
  </script>
  <!--end::OverlayScrollbars Configure-->
  <!--end::Script-->
</body>
<!--end::Body-->

</html>