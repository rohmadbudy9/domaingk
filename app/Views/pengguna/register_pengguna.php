<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Form Tambah User </h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!--begin::App Content-->
  <div class="app-content">
    <div class="container-fluid">
      <div class="row g-4">
        <?php if (session()->getFlashdata('success')): ?>
          <p style="color: green;"><?= session()->getFlashdata('success'); ?></p>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
          <p style="color: red;"><?= session()->getFlashdata('error'); ?></p>
        <?php endif; ?>

        <div class="col-md-8">
          <div class="card card-primary card-outline mb-4">
            <!--begin::Form-->
            <form action="<?= base_url('/pengguna/insert') ?>" method="post" id="registerForm" novalidate>
              <?= csrf_field() ?>

              <div class="card-body">
                <!-- Username -->
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    placeholder="Username"
                    required />
                </div>

                <!-- Password -->
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Password"
                    required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$"
                    title="Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka." />
                  <small class="text-muted">
                    Password harus minimal <b>8 karakter</b> dan mengandung huruf besar, huruf kecil, serta angka.
                  </small>
                </div>

                <!-- Level User -->
                <div class="col-md-6">
                  <label for="level_user" class="form-label">Level User</label>
                  <select name="level_user" id="level_user" class="form-select" required>
                    <option selected disabled value="">Pilih Level User</option>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                  </select>
                </div>

                <!-- Submit -->
                <div class="card-footer mt-3">
                  <button type="submit" class="btn btn-primary">Register User</button>
                </div>
              </div>
            </form>
            <!--end::Form-->
          </div>

          <!--begin::JavaScript Validation-->
          <script>
            document.getElementById('registerForm').addEventListener('submit', function(event) {
              const password = document.getElementById('password').value;
              const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

              if (!regex.test(password)) {
                event.preventDefault();
                alert('Password harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, serta angka.');
              }
            });
          </script>
          <!--end::JavaScript Validation-->

        </div>
      </div>
    </div>
  </div>
</main>
<?= $this->endSection() ?>