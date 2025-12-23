$(document).ready(function () {
  Swal.fire({
    title: "Loading...",
    text: "",
    allowOutsideClick: false,
    showConfirmButton: false,
    didOpen: () => {
      Swal.showLoading();
    },
    showClass: {
      popup: "animate__animated animate__swing",
    },

    hideClass: {
      popup: "animate__animated animate__fadeOutUp",
    },
  });
  Promise.all([loadUsersTable()]).then(() => {
    Swal.close();
  });
  initAddButton();
  ExisTabelUser();
  optionLevel();
});
function initAddButton() {
  $("#adduser").on("click", function () {
    addUser();
  });

  $("#btn-add-user").on("click", function () {
    $("#user-form")[0].reset();
    $("#user_id").val("");
    $("#modal-title").text("Tambah Pengguna Baru");
    $("#user-modal").modal("show");
  });
}
function optionLevel() {
  $("#optionLevel").select2({
    placeholder: "Pilih Level",
    width: "100%",
    allowClear: true,
    dropdownParent: $("#user-modal"),
    ajax: {
      url: BaseUrlJsQ + "option/opslevelnonsuper",
      type: "GET",
      dataType: "JSON",
      delay: 250,
      data: function (params) {
        return {
          term: params.term,
        };
      },
      processResults: function (response) {
        return {
          results: response,
        };
      },
      cache: true,
    },
    escapeMarkup: function (m) {
      return m;
    },
    language: {
      noResults: function () {
        return "Tidak ada data!";
      },
    },
  });
}
function loadUsersTable() {
  return new Promise((resolve) => {
    if (tbuser && $.fn.DataTable.isDataTable("#tbuser")) {
      tbuser.clear().destroy();
    }
    tbuser = $("#tbuser").DataTable({
      responsive: true,
      autoWidth: false,
      lengthChange: false,
      paging: true,
      searching: true,
      ordering: true,
      info: true,
      type: "JSON",
      method: "GET",
      ajax: BaseUrlJsQ + "admin/list_users",
      columns: [
        {
          data: null,
          className: "text-center",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
        },
        { data: "nama_lengkap" },
        { data: "username" },
        { data: "email" },
        { data: "level" },
        {
          data: "is_active",
          className: "text-center",
          render: function (data, type, row) {
            return data == 1 ? "Aktif" : "Tidak Aktif";
          },
        },
        {
          data: null,
          className: "text-center",
          orderable: false,
          render: function (data, type, row) {
            return ' <div class="btn-group-action"><span class=" btn-edit"><i class="ri-edit-2-fill"></i></span>&nbsp;<span class=" btn-delete" ><i class="ri-delete-bin-6-line"></i></span></div>';
          },
        },
      ],
      language: {
        searchPlaceholder: "Search...",
        sSearch: "",
      },
      lengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, "All"],
      ],
      order: [[0, "asc"]],
      columnDefs: [
        {
          targets: [0],
          className: "text-center",
        },
      ],
    });
    $("#tbuser").on("xhr.dt", function () {
      resolve();
    });
  });
}
function addUser() {
  Swal.fire({
    title: "Mohon tunggu...",
    text: "Sedang memproses data",
    allowOutsideClick: false,
    showConfirmButton: false,
    willOpen: () => {
      Swal.showLoading();
    },
    didOpen: () => {
      Swal.showLoading();
    },
  });

  const formData = $("#user-form").serializeArray();
  const csrfName = $('meta[name="csrf-token-name"]').attr("content");
  const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");
  formData.push({ name: csrfName, value: csrfHash });

  $.ajax({
    url: BaseUrlJsQ + "admin/store_users",
    type: "POST",
    dataType: "json",
    data: $.param(formData),
    success: function (response) {
      Swal.close();
      $('meta[name="csrf-token-hash"]').attr("content", response.csrf_baru);
      if (response.status) {
        toastr.success(response.pesan, "Success", {
          timeOut: 3000,
        });
        $("#user-form")[0].reset();
        $("#user-form select").each(function () {
          $(this).val("").trigger("change");
        });
      } else {
        toastr.error(response.pesan, "Error", {
          timeOut: 3000,
        });
      }
      $("#user-modal").modal("hide");
      tbuser.ajax.reload();
    },
    error: function (jqXHR) {
      Swal.close();
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
function ExisTabelUser() {
  $(".btn-cancel").on("click", function () {
    $("#user-modal").modal("hide");
  });
  $("#tbuser").on("click", "span", function () {
    let tr = $(this).closest("tr");
    let data = tbuser.row(tr).data();
    if (tr.hasClass("child")) {
      tr = tr.prev();
      data = tbuser.row(tr).data();
    }
    if ($(this).hasClass("btn-delete")) {
      dellData(data.id);
    } else if ($(this).hasClass("btn-edit")) {
      $("#user-form")[0].reset();
      $("#user_id").val(data.id);
      $("#nama_lengkap").val(data.nama_lengkap);
      $("#username").val(data.username);
      $("#email").val(data.email);
      $("#is_active").prop("checked", data.is_active == 1);
      // $("#optionLevel")
      //   .empty()
      //   .append(new Option(data.level, data.user_level_id, true, true))
      //   .trigger("change");
      var $setoptb = $("<option selected='selected'></option>")
        .val(data.user_level_id)
        .text(data.level);
      $("#optionLevel").append($setoptb).trigger("change");
      $("#modal-title").text("Edit Pengguna");
      $("#user-modal").modal("show");
    }
  });
}
function dellData(id) {
  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Data akan dihapus dan tidak dapat dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Mohon tunggu...",
        text: "Sedang memproses data",
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });
      const csrfName = $('meta[name="csrf-token-name"]').attr("content");
      const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");
      let data = {
        id: id,
        [csrfName]: csrfHash,
      };
      $.ajax({
        url: BaseUrlJsQ + "admin/dell_users",
        type: "POST",
        dataType: "JSON",
        data: data,
        success: function (response) {
          Swal.close();
          if (response.status) {
            $('meta[name="csrf-token-hash"]').attr(
              "content",
              response.csrf_baru
            );
            toastr.success(response.pesan, "Success", {
              timeOut: 1500,
            });
            tbuser.ajax.reload();
          } else {
            $('meta[name="csrf-token-hash"]').attr(
              "content",
              response.csrf_baru
            );
            toastr.error(response.pesan, "Error", {
              timeOut: 1500,
            });
          }
        },
        error: function (jqXHR) {
          Swal.close();
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
  });
}
