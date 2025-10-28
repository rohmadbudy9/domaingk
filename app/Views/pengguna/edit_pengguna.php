<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Form Edit User</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="row g-4">
        <div class="col-md-8">
          <div class="card card-primary card-outline mb-4">
            <form action="<?= base_url('/pengguna/update/' . $users['id']) ?>" method="post" id="editUserForm">
              <?= csrf_field() ?>
              <div class="card-body">

                <!-- Username -->
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    name="username"
                    id="username"
                    value="<?= esc($users['username']) ?>"
                    class="form-control"
                    required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                  <label class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="••••••••"
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$"
                    title="Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.">
                  <small class="text-muted">
                    Jika diisi, password harus minimal <b>8 karakter</b> dengan huruf besar, kecil, dan angka.
                  </small>
                </div>

                <!-- Level User -->
                <div class="mb-3">
                  <label for="level_user" class="form-label">Level User</label>
                  <select name="level_user" id="level_user" class="form-select" required>
                    <option selected disabled value="">Pilih Level User</option>
                    <option value="User" <?= ($users['level_user'] == 'User') ? 'selected' : '' ?>>User</option>
                    <option value="Admin" <?= ($users['level_user'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
                  </select>
                </div>

                <!-- Submit -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
          </div>

          <!-- ✅ JavaScript Validasi Password -->
          <script>
            document.getElementById('editUserForm').addEventListener('submit', function(event) {
              const password = document.getElementById('password').value;
              const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

              // Validasi hanya jika password diisi
              if (password && !regex.test(password)) {
                event.preventDefault();
                alert('Password harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, serta angka.');
              }
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection() ?>