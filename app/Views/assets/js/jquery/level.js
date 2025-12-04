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
  Promise.all([ReloadTabelLevel()]).then(() => {
    Swal.close();
  });
  initAddButton();
  ExisDataLevel();
});

function initAddButton() {
  $(".add").on("click", function () {
    addLevel();
  });
  $("#btn-add-level").on("click", function () {
    $("#FormEntriLevel")[0].reset();
    $("#FormEntriLevel select").each(function () {
      $(this).val("").trigger("change");
    });
    $("#modal-addakses").modal("show");
  });
}
function ReloadTabelLevel() {
  return new Promise((resolve) => {
    if (DataTabelLevel && $.fn.DataTable.isDataTable("#DataTabelLevel")) {
      DataTabelLevel.clear().destroy();
    }
    DataTabelLevel = $("#DataTabelLevel").DataTable({
      responsive: true,
      autoWidth: false,
      lengthChange: false,
      paging: true,
      searching: true,
      ordering: true,
      info: true,
      type: "JSON",
      method: "GET",
      ajax: BaseUrlJsQ + "superman/list_Level",
      columns: [
        {
          data: null,
          className: "text-center",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
        },
        { data: "level" },
        {
          data: null,
          render: function (data, type, row, meta) {
            return ' <div class="btn-group-action"><span class="btnubahizin "><i class="ri-file-settings-fill"></i></span>&nbsp;<span class="ubah-level" ><i class="ri-edit-2-fill"></i></span>&nbsp;<span class="BtnHapusDataLevel" ><i class="ri-delete-bin-6-line"></i></span></div>';
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
    $("#DataTabelLevel").on("xhr.dt", function () {
      resolve();
    });
  });
}
function addLevel() {
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

  const formData = $("#FormEntriLevel").serializeArray();
  const csrfName = $('meta[name="csrf-token-name"]').attr("content");
  const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");
  formData.push({ name: csrfName, value: csrfHash });

  $.ajax({
    url: BaseUrlJsQ + "superman/store_Level",
    type: "POST",
    dataType: "JSON",
    data: $.param(formData),
    success: function (response) {
      Swal.close();
      $('meta[name="csrf-token-hash"]').attr("content", response.csrf_baru);
      if (response.status) {
        toastr.success(response.pesan, "Success", {
          timeOut: 3000,
        });
        $("#FormEntriLevel")[0].reset();
        $("#FormEntriLevel select").each(function () {
          $(this).val("").trigger("change");
        });
      } else {
        toastr.error(response.pesan, "Error", {
          timeOut: 3000,
        });
      }
      $("#modal-addakses").modal("hide");
      DataTabelLevel.ajax.reload();
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
function ExisDataLevel() {
  $(".cancel-1").on("click", function () {
    $("#modal-addakses").modal("hide");
  });
  $(".cancel-2").on("click", function () {
    $("#modal-izin").modal("hide");
  });
  $("#DataTabelLevel").on("click", "span", function () {
    var data = DataTabelLevel.row($(this).parents("tr")).data();
    if ($(this).hasClass("BtnHapusDataLevel")) {
      HapusDataLevel(data.id);
    } else if ($(this).hasClass("ubah-level")) {
      $("#modal-addakses").modal("show");
      $("#IdLevel").val(data.id);
      $("#NamaLevel").val(data.level);
    } else if ($(this).hasClass("btnubahizin")) {
      $("#idlevelinMod").val(data.id);
      $("#modal-izin").modal("show");
      ReloadMenuLinkAkses();
    }
  });
}
function ReloadMenuLinkAkses() {
  return new Promise((resolve) => {
    if (DataTabelIzin && $.fn.DataTable.isDataTable("#DataTabelIzin")) {
      DataTabelIzin.clear().destroy();
    }

    const idLevel = $("#idlevelinMod").val();

    DataTabelIzin = $("#DataTabelIzin").DataTable({
      responsive: true,
      autoWidth: false,
      paging: true,
      searching: false,
      ordering: true,
      info: true,
      ajax: {
        url: BaseUrlJsQ + "superman/list_menu_by_level",
        data: {
          idlevel: idLevel,
        },
        dataSrc: "data",
      },
      columns: [
        {
          data: null,
          render: (data, type, row, meta) => meta.row + 1,
        },
        {
          data: "nama",
        },
        {
          data: null,
          className: "text-center",
          render: function (data, type, row, meta) {
            const checked = row.akses === "1" ? "checked" : "";
            return `<input type="checkbox" class="form-check-input akses-checkbox"
                    data-idmenu="${row.id}" data-idlevel="${idLevel}" ${checked}>`;
          },
        },
      ],
      language: {
        searchPlaceholder: "Search...",
        sSearch: "",
      },
      order: [[0, "asc"]],
    });

    $("#DataTabelIzin").on("xhr.dt", function () {
      resolve();
    });

    $("#DataTabelIzin tbody")
      .off("click")
      .on("click", ".akses-checkbox", function () {
        Swal.fire({
          title: "Mohon tunggu...",
          text: "Sedang memproses data",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        const idmenu = $(this).data("idmenu");
        const idlevel = $(this).data("idlevel");
        const csrfName = $('meta[name="csrf-token-name"]').attr("content");
        const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");

        $.ajax({
          url: BaseUrlJsQ + "superman/change_akses_menu",
          type: "POST",
          dataType: "JSON",
          data: {
            idmenu: idmenu,
            idlevel: idlevel,
            [csrfName]: csrfHash,
          },
          success: function (response) {
            $('meta[name="csrf-token-hash"]').attr(
              "content",
              response.csrf_baru
            );
            Swal.close();
            if (response.status) {
              toastr.success(response.pesan, "Sukses", {
                timeOut: 1500,
              });
            } else {
              toastr.error(response.pesan, "Gagal", {
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
      });
  });
}
function HapusDataLevel(id) {
  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Data akan dihapus dan tidak dapat dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      const csrfName = $('meta[name="csrf-token-name"]').attr("content");
      const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");
      let data = {
        id: id,
        [csrfName]: csrfHash,
      };
      $.ajax({
        url: BaseUrlJsQ + "superman/dell_Level",
        type: "POST",
        dataType: "JSON",
        data: data,
        success: function (response) {
          $('meta[name="csrf-token-hash"]').attr("content", response.csrf_baru);
          if (response.status) {
            toastr.success(response.pesan, "Success", {
              timeOut: 1500,
            });
            DataTabelLevel.ajax.reload();
          } else {
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
