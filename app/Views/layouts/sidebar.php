    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="<?= base_url('/dashboard') ?>" class="brand-link">
          <!--begin::Brand Image-->
          <img
            src="dist/assets/img/logo.png"
            alt="Logo Gunungkidul"
            class="brand-image opacity-75 shadow" />
          <!--end::Brand Image-->
          <!--begin::Brand Text-->
          <span class="brand-text fw-light">Cek Domain GK v2</span>
          <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <!--begin::Sidebar Menu-->
          <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="menu"
            data-accordion="false">
            <li class="nav-item menu-open">
              <a href="<?= base_url('/dashboard') ?>" class="nav-link active">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>
                  Beranda
                </p>
              </a>
            </li>
          </ul>
          <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="menu"
            data-accordion="false">
            <li class="nav-item menu-open">
              <a href="<?= base_url('/report') ?>" class="nav-link active">
                <i class="nav-icon bi bi-clipboard-fill"></i>
                <p>
                  Report Website
                </p>
              </a>
            </li>
          </ul>
          <?php if (session()->get('level_user') == 'Admin'): ?>
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false">
              <li class="nav-item menu-open">
                <a href="<?= base_url('/data/add') ?>" class="nav-link active">
                  <i class="nav-icon bi bi-database-add"></i>
                  <p>Tambah Data</p>
                </a>
              </li>
            </ul>
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false">
              <li class="nav-item menu-open">
                <a href="<?= base_url('/pengguna/register') ?>" class="nav-link active">
                  <i class="nav-icon bi bi-person-fill-add"></i>
                  <p>Tambah Pengguna</p>
                </a>
              </li>
            </ul>
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false">
              <li class="nav-item menu-open">
                <a href="<?= base_url('/pengguna') ?>" class="nav-link active">
                  <i class="nav-icon bi bi-people-fill"></i>
                  <p>
                    List Pengguna
                  </p>
                </a>
              </li>
            </ul>
          <?php endif; ?>

          <!--end::Sidebar Menu-->
        </nav>
      </div>
      <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->