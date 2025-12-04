$(document).ready(function () {
  exisbutton();
  toastr.options = {
    positionClass: "toast-top-center",
    progressBar: true,
    closeButton: false,
  };
});
function exisbutton() {
   $('#theme-settings-offcanvas').on('change', 'input[name="data-bs-theme"]', function() {
        saveThemeSetting('color_scheme', $(this).val());
    });

    $('#theme-settings-offcanvas').on('change', 'input[name="data-layout-mode"]', function() {
        saveThemeSetting('layout_mode', $(this).val());
    });

    $('#theme-settings-offcanvas').on('change', 'input[name="data-topbar-color"]', function() {
        saveThemeSetting('topbar_color', $(this).val());
    });

    $('#theme-settings-offcanvas').on('change', 'input[name="data-menu-color"]', function() {
        saveThemeSetting('menu_color', $(this).val());
    });

    $('#theme-settings-offcanvas').on('change', 'input[name="data-sidenav-size"]', function() {
        saveThemeSetting('sidebar_size', $(this).val());
    });

    $('#theme-settings-offcanvas').on('change', 'input[name="data-layout-position"]', function() {
        saveThemeSetting('layout_position', $(this).val());
    });

    $('#theme-settings-offcanvas').on('change', 'input[name="sidebar-user"]', function() {
        saveThemeSetting('sidebar_user_info', $(this).is(':checked'));
    });
}
function saveThemeSetting(settingName, settingValue) {
        const csrfName = $('meta[name="csrf-token-name"]').attr('content');
        let csrfHash = $('meta[name="csrf-token-hash"]').attr('content');

        let postData = {
            [csrfName]: csrfHash,
            setting_name: settingName,
            setting_value: settingValue
        };

        $.ajax({
        url: BaseUrlJsQ + "admin/save-theme",
            type: "POST",
            data: postData,
            dataType: "json",
            success: function(response) {
               $('meta[name="csrf-token-hash"]').attr("content", response.csrf_baru);
                if (response.status === 'success') {
                    toastr.success(settingName + " tersimpan: " + settingValue, "Berhasil");
                } else {
                    toastr.error('Failed to save setting:', response.message);
                }
            },
            error: function (jqXHR) {
         if (jqXHR.responseJSON && jqXHR.responseJSON.csrf_baru) {
        $('meta[name="csrf-token-hash"]').attr(
          "content",
          jqXHR.responseJSON.csrf_baru
        );
      }
      let errors = jqXHR.responseJSON.pesan;
      toastr.error(errors, "Error", {
        timeOut: 3000,
      });
    },
        });
    }
