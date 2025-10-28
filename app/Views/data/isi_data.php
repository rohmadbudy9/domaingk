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
          <h3 class="mb-0">List Website <?= $kategori ?></h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $kategori ?></li>
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
              <form action="<?= base_url('/report/submitreport') ?>" method="post">
                <?= csrf_field() ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No.</th>
                      <th>Nama <?= $kategori ?></th>
                      <th>Alamat Website</th>
                      <th>Status Website</th>
                      <th>Keterangan</th>
                      <?php if (session()->get('level_user') == 'Admin'): ?>
                        <th style="width: 140px">Aksi</th>
                      <?php endif; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($websites as $web): ?>
                      <tr class="align-middle">
                        <td><?php echo $i++; ?></td>
                        <td><?= $web['nama_opd'] ?></td>
                        <td><a href="<?= $web['alamat_web'] ?>" target="_blank"><?= $web['alamat_web'] ?></a> </td>
                        <td><select name="status[<?= $web['id'] ?>]" class="form-control status-dropdown" data-id="<?= $web['id'] ?>">
                            <option selected disabled value="">Pilih Status</option>
                            <option value="up">🟢 Up</option>
                            <option value="down">🔴 Down</option>
                          </select></td>
                        <td>
                          <input type="text" name="note[<?= $web['id'] ?>]" class="form-control note-field" id="note-<?= $web['id'] ?>" placeholder="Isi jika down" disabled>
                        </td>
                        <?php if (session()->get('level_user') == 'Admin'): ?>
                          <td>
                            <button type="submit" class="btn btn-primary"><a href="<?= base_url('/data/edit/' . $web['id']) ?>" class="text-light">Edit</a></button>
                            <button type="submit" class="btn btn-danger"><a href="<?= base_url('/data/delete/' . $web['id']) ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-light">Delete</a></button>
                          </td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  </td>
                </table>
                <button type="submit" class="btn btn-primary">Submit Report</button>
              </form>

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
<script>
  document.querySelectorAll('.status-dropdown').forEach(function(dropdown) {
    dropdown.addEventListener('change', function() {
      const id = this.dataset.id;
      const noteInput = document.getElementById('note-' + id);
      if (this.value === 'down') {
        noteInput.removeAttribute('disabled');
      } else {
        noteInput.value = '';
        noteInput.setAttribute('disabled', true);
      }
    });
  });
</script>
<?= $this->endSection() ?>