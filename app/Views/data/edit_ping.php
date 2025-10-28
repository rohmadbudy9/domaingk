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
          <h3 class="mb-0">Form Edit Data Website </h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Data</li>
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
      <div class="row g-4">
        <!--begin::Col-->
        <div class="col-md-8">
          <!--begin::Quick Example-->

          <div class="card card-primary card-outline mb-4">
            <!--begin::Form-->
            <form action="<?= base_url('/data/updateping/' . $website['id']) ?>" method="post">
              <!--begin::Body-->
              <div class="card-body">
                <div class="mb-3">
                  <label for="" class="form-label">Nama OPD</label>
                  <input
                    type="text"
                    value="<?= $website['nama_opd'] ?>"
                    class="form-control"
                    name="nama_opd"
                    required>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Alamat Website</label>
                  <input
                    type="url"
                    value="<?= $website['alamat_web'] ?>" class="form-control"
                    name="alamat_web"
                    required>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom04" class="form-label">Kategori</label>
                  <select name="kategori" class="form-select" required>
                    <option selected disabled value="">Pilih Kategori</option>
                    <option value="OPD" <?= ($website['kategori'] == 'OPD') ? 'selected' : '' ?>>OPD</option>
                    <option value="Kapanewon" <?= ($website['kategori'] == 'Kapanewon') ? 'selected' : '' ?>>Kapanewon</option>
                    <option value="Puskesmas" <?= ($website['kategori'] == 'Puskesmas') ? 'selected' : '' ?>>Puskesmas</option>
                    <option value="Puskeswan" <?= ($website['kategori'] == 'Puskeswan') ? 'selected' : '' ?>>Puskeswan</option>
                    <option value="BPP" <?= ($website['kategori'] == 'BPP') ? 'selected' : '' ?>>BPP</option>
                    <option value="IKM" <?= ($website['kategori'] == 'IKM') ? 'selected' : '' ?>>IKM</option>
                    <option value="Other" <?= ($website['kategori'] == 'Other') ? 'selected' : '' ?>>Other</option>
                    <option value="Cekslot" <?= ($website['kategori'] == 'Cekslot') ? 'selected' : '' ?>>Cekslot</option>
                    <option value="Ping" <?= ($website['kategori'] == 'Ping') ? 'selected' : '' ?>>Ping</option>
                  </select>
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <!--end::Footer-->
              </div>
            </form>
            <!--end::Form-->
          </div>
          <!--begin::JavaScript-->
          <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
              'use strict';

              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              const forms = document.querySelectorAll('.needs-validation');

              // Loop over them and prevent submission
              Array.from(forms).forEach((form) => {
                form.addEventListener(
                  'submit',
                  (event) => {
                    if (!form.checkValidity()) {
                      event.preventDefault();
                      event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                  },
                  false,
                );
              });
            })();
          </script>
          <!--end::JavaScript-->
        </div>
        <!--end::Form Validation-->
      </div>
      <!--end::Col-->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->
<?= $this->endSection() ?>