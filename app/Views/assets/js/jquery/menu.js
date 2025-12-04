$(document).ready(function () {
  Swal.fire({
    title: "Loading...",
    text: "",
    allowOutsideClick: false,
    showConfirmButton: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });
  Promise.all([ReloadTabelMenu()]).then(() => {
    Swal.close();
  });

  initAddButton();
  ExisDataMenu();
  CopyIcon();
  CopyIconBase();
});
function initAddButton() {
  $(".add").on("click", function () {
    addMenu();
  });
  $("#btn-add-menu").on("click", function () {
    $("#FormEntrianMenu")[0].reset();
    $("#FormEntrianMenu select").each(function () {
      $(this).val("").trigger("change");
    });
    $("#modal-addMenu").modal("show");
  });

  $("#btn-buka-pilihan-icon").on("click", function () {
    $("#pilihiCon").modal("show");
  });
  $("#pilihiCon").on("click", "#icons .row > div", function (event) {
    event.stopPropagation();

    const iconClass = $(this).find("i").attr("class");

    if (iconClass) {
      $("#IconMenu").val(iconClass);
      $("#TampilIcon").html('<i class="' + iconClass + ' fs-20"></i>');
      $("#pilihiCon").modal("hide");
    }
  });
}
function ReloadTabelMenu() {
  return new Promise((resolve) => {
    if (DataTabelMenu && $.fn.DataTable.isDataTable("#DataTabelMenu")) {
      DataTabelMenu.clear().destroy();
    }
    DataTabelMenu = $("#DataTabelMenu").DataTable({
      responsive: true,
      autoWidth: false,
      lengthChange: false,
      paging: true,
      searching: true,
      ordering: true,
      info: true,
      type: "JSON",
      method: "GET",
      ajax: BaseUrlJsQ + "superman/list_menu",
      columns: [
        {
          data: null,
          className: "text-center",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
        },
        { data: "nama" },
        {
          data: "icon",
          textAlign: "left",
          render: function (data, type, row) {
            return '<i class="' + data + '"></i>';
          },
        },
        { data: "urutan" },
        {
          data: null,
          className: "text-center",
          orderable: false,
          render: function (data, type, row) {
            return ' <div class="btn-group-action"><span class="btn-edit"><i class="ri-edit-2-fill"></i></span>&nbsp;<span class="btn-delete" ><i class="ri-delete-bin-6-line"></i></span></div>';
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
    $("#DataTabelMenu").on("xhr.dt", function () {
      resolve();
    });
  });
}
function addMenu() {
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

  const formData = $("#FormEntrianMenu").serializeArray();
  const csrfName = $('meta[name="csrf-token-name"]').attr("content");
  const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");
  formData.push({ name: csrfName, value: csrfHash });

  $.ajax({
    url: BaseUrlJsQ + "superman/store_menu",
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
        $("#FormEntrianMenu")[0].reset();
        $("#FormEntrianMenu select").each(function () {
          $(this).val("").trigger("change");
        });
      } else {
        toastr.error(response.pesan, "Error", {
          timeOut: 3000,
        });
      }
      $("#modal-addMenu").modal("hide");
      DataTabelMenu.ajax.reload();
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
function ExisDataMenu() {
  $(".cancel").on("click", function () {
    $("#modal-addMenu").modal("hide");
  });
  $("#DataTabelMenu").on("click", "span", function () {
    var tr = $(this).closest("tr");
    var data = DataTabelMenu.row(tr).data();
    if (tr.hasClass("child")) {
      tr = tr.prev();
      data = DataTabelMenu.row(tr).data();
    }
    if ($(this).hasClass("btn-delete")) {
      dellData(data.id);
    } else if ($(this).hasClass("btn-edit")) {
      $("#modal-addMenu").modal("show");
      $("#IdMenu").val(data.id);
      $("#NamaMenu").val(data.nama);
      $("#UrutanMenu").val(data.urutan);
      $("#IconMenu").val(data.icon);
      $("#TampilIcon").html('<i class="' + data.icon + '"></i>');
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
        url: BaseUrlJsQ + "superman/dell_menu",
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
            DataTabelMenu.ajax.reload();
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
function CopyIcon() {
  document.querySelectorAll(".icon-selector").forEach(function (iconLink) {
    iconLink.addEventListener("click", function (event) {
      event.preventDefault();
      var iconClass = this.getAttribute("data-icon");
      document.getElementById("IconMenu").value = iconClass;
      document.getElementById("TampilIcon").innerHTML =
        '<i class="' + iconClass + '"></i>';
      $("#v_icons").modal("hide");
    });
  });
}
function CopyIconBase() {
  document.querySelectorAll(".icon-selector2").forEach(function (iconLink) {
    iconLink.addEventListener("click", function (event) {
      event.preventDefault();
      var iconClass = this.getAttribute("data-icon");
      var tempInput = document.createElement("textarea");
      tempInput.value = iconClass;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand("copy");
      document.body.removeChild(tempInput);
      toastr.success("Icon tersalin", "Success", {
        timeOut: 1500,
      });
    });
  });
}
