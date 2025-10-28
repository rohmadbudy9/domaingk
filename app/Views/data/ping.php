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
          <h3 class="mb-0">List Ping Domain</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ping</li>
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
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No.</th>
                      <th>Nama Domain</th>
                      <th>Alamat Website</th>
                      <th>Status Website</th>
                      <th>Keterangan</th>
                      <th>Ping Domain</th>
                      <?php if (session()->get('level_user') == 'Admin'): ?>
                        <th style="width: 140px">Aksi</th>
                      <?php endif; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($websites as $web): ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><?= esc($web['nama_opd']); ?></td>
                        <td><a href="<?= $web['alamat_web'] ?>" target="_blank"><?= $web['alamat_web'] ?></a> </td>
                        <td><select name="status[<?= $web['id'] ?>]" class="form-control status-dropdown" data-id="<?= $web['id'] ?>">
                            <option selected disabled value="">Pilih Status</option>
                            <option value="up">🟢 Up</option>
                            <option value="down">🔴 Down</option>
                          </select></td>
                        <td>
                          <input type="text" name="note[<?= $web['id'] ?>]" class="form-control note-field" id="note-<?= $web['id'] ?>" placeholder="Isi jika down" disabled>
                        </td>
                        <td>
                          <button class="btn btn-info pingButton" data-id="<?= $web['id']; ?>">Cek Koneksi</button>
                          <pre id="pingResult" style="
                        background: black;    
                        color: white;    
                        padding: 10px;    
                        margin-top: 10px;    
                        max-height: 250px;     
                        overflow-y: auto;    
                        font-size: 14px; 
                        white-space: pre-wrap;"></pre>
                        </td>
                        <?php if (session()->get('level_user') == 'Admin'): ?>
                          <td>
                            <button type="submit" class="btn btn-primary"><a href="<?= base_url('/data/editping/' . $web['id']) ?>" class="text-light">Edit</a></button>
                            <button type="submit" class="btn btn-danger"><a href="<?= base_url('/data/deleteping/' . $web['id']) ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-light">Delete</a></button>
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
  document.querySelectorAll(".pingButton").forEach(button => {
    button.addEventListener("click", function() {
      let id = this.getAttribute("data-id");
      let resultElement = this.nextElementSibling;
      resultElement.innerHTML = "Sedang melakukan ping...";

      fetch("<?= base_url('/ping/') ?>" + id)
        .then(response => response.json())
        .then(data => {
          if (data.status === "success") {
            resultElement.innerHTML = "<span style='color: green;'>" + data.message + "</span>";
          } else {
            resultElement.innerHTML = "<span style='color: red;'>" + data.message + "</span>";
          }
        })
        .catch(error => {
          resultElement.innerHTML = "<span style='color: red;'>Gagal melakukan ping</span>";
        });
    });
  });
</script>
<?= $this->endSection() ?>