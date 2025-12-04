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
  Promise.all([ReloadDataTabelSubmenu()]).then(() => {
    Swal.close();
  });

  initAddButton();
  ExisDataMenu();
  OptionsMenu();
});
function initAddButton() {
  $(".add").on("click", function () {
    addSubmenu();
  });
  $("#btn-add-submenu").on("click", function () {
    $("#FormEntrianSubmenu")[0].reset();
    $("#FormEntrianSubmenu select").each(function () {
      $(this).val("").trigger("change");
    });
    $("#modal-addsubmenu").modal("show");
  });
}
function ReloadDataTabelSubmenu() {
  return new Promise((resolve) => {
    if (DataTabelSubmenu && $.fn.DataTable.isDataTable("#DataTabelSubmenu")) {
      DataTabelSubmenu.clear().destroy();
    }
    DataTabelSubmenu = $("#DataTabelSubmenu").DataTable({
      responsive: true,
      autoWidth: false,
      lengthChange: false,
      paging: true,
      searching: true,
      ordering: true,
      info: true,
      type: "JSON",
      method: "GET",
      ajax: BaseUrlJsQ + "superman/list_submenu",
      columns: [
        {
          data: null,
          className: "text-center",
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
        },
        { data: "nama" },
        { data: "url" },
        { data: "namamenu" },

        {
          data: null,
          className: "text-center",
          orderable: false,
          render: function (data, type, row) {
            return ' <div class="btn-group-action"><span class=" btn-edit"><i class="ri-edit-2-fill"></i></span>&nbsp;<span class=" btn-delete " ><i class="ri-delete-bin-6-line"></i></span></div>';
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
    $("#DataTabelSubmenu").on("xhr.dt", function () {
      resolve();
    });
  });
}
function addSubmenu() {
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

  const formData = $("#FormEntrianSubmenu").serializeArray();
  const csrfName = $('meta[name="csrf-token-name"]').attr("content");
  const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");
  formData.push({ name: csrfName, value: csrfHash });

  $.ajax({
    url: BaseUrlJsQ + "superman/store_submenu",
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
        $("#FormEntrianSubmenu")[0].reset();
        $("#FormEntrianSubmenu select").each(function () {
          $(this).val("").trigger("change");
        });
      } else {
        toastr.error(response.pesan, "Error", {
          timeOut: 3000,
        });
      }
      $("#modal-addsubmenu").modal("hide");
      DataTabelSubmenu.ajax.reload();
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
    $("#modal-addsubmenu").modal("hide");
  });

  $("#DataTabelSubmenu").on("click", "span", function () {
    var tr = $(this).closest("tr");
    var data = DataTabelSubmenu.row(tr).data();
    if (tr.hasClass("child")) {
      tr = tr.prev();
      data = DataTabelSubmenu.row(tr).data();
    }

    if ($(this).hasClass("btn-delete")) {
      dellData(data.id);
    } else if ($(this).hasClass("btn-edit")) {
      $("#modal-addsubmenu").modal("show");
      $("#IdSubmenu").val(data.idsubmenu);
      $("#NamaSubmenu").val(data.namasubmenu);
      $("#DirectTo").val(data.url);
      $("#IconSubmenu").val(data.icon);
      $("#TampilIconSubmenu").html('<i class="' + data.icon + '"></i>');
      if (choices) {
        choices.setChoiceByValue(String(data.idmenu));
      }
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
        url: BaseUrlJsQ + "superman/dell_submenu",
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
            DataTabelSubmenu.ajax.reload();
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

let choices;

function OptionsMenu() {
  const optionMenu = document.getElementById("OptionMenu");
  choices = new Choices(optionMenu, {
    removeItemButton: true,
    searchEnabled: true,
    searchPlaceholderValue: "Cari menu...",
    noResultsText: "Tidak ada data!",
    itemSelectText: "",
    duplicateItemsAllowed: false,
    allowHTML: true,
  });

  fetch(BaseUrlJsQ + "option/opsmenu")
    .then((res) => res.json())
    .then((data) => {
      choices.setChoices(data, "id", "text", true);
    });
}
