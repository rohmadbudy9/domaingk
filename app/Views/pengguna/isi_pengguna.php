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
          <h3 class="mb-0">List Pengguna </h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Pengguna</li>
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
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No.</th>
                    <th>Nama</th>
                    <th>Level User</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  foreach ($users as $user): ?>
                    <tr class="align-middle">
                      <td><?php echo $i++; ?></td>
                      <td><?= $user['username'] ?></td>
                      <td><?= $user['level_user'] ?></td>
                      <td>
                        <button type="submit" class="btn btn-primary"><a href="<?= base_url('/pengguna/edit/' . $user['id']) ?>" class="text-light">Edit</a></button>
                        <button type="submit" class="btn btn-danger"><a href="<?= base_url('/pengguna/delete/' . $user['id']) ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-light">Delete</a></button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                </td>
              </table>
              <!-- 
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-end">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>

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