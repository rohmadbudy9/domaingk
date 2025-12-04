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
  Promise.all([Rtb_a1()]).then(() => {
    Swal.close();
  });

  init();
  exis();
});
function init() {
  $(".add").on("click", function () {
    add();
  });
  $("#bShowM_p").on("click", function () {
    $("#f_aP1")[0].reset();
    $("#f_aP1 select").each(function () {
      $(this).val("").trigger("change");
    });
    $("#moP").modal("show");
  });
  $(document).on("click", ".copy-url", function (e) {
    e.preventDefault();
    const url = $(this).data("url");

    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(url).then(() => {
        if (window.toastr) toastr.success("Tersalin ke clipboard");
      });
    } else {
      const $temp = $("<input>");
      $("body").append($temp);
      $temp.val(url).select();
      document.execCommand("copy");
      $temp.remove();
      if (window.toastr) toastr.success("Tersalin ke clipboard");
    }
  });
}

function Rtb_a1() {
  return new Promise((resolve) => {
    if (x01_ && $.fn.DataTable.isDataTable("#x01_")) {
      x01_.clear().destroy();
    }
    x01_ = $("#x01_").DataTable({
      responsive: true,
      autoWidth: false,
      lengthChange: false,
      paging: true,
      searching: true,
      ordering: true,
      info: true,
      type: "JSON",
      method: "GET",
      ajax: BaseUrlJsQ + "admin/presensi/list",
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
          data: null,
          render: function (data, type, row) {
            const url = `https://presensi.codegarp.biz.id/get/${row.kode_absen}`;
            return `<a href="javascript:void(0)" class="copy-url" data-url="${url}">${url}</a>`;
          },
        },

        { data: "dev_id" },
        { data: "status" },
        {
          data: null,
          render: function (data, type, row) {
            return `${row.tgl_mulai}-${row.tgl_akhir}`;
          },
        },
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
    $("#x01_").on("xhr.dt", function () {
      resolve();
    });
  });
}
function add() {
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

  const formData = $("#f_aP1").serializeArray();
  const csrfName = $('meta[name="csrf-token-name"]').attr("content");
  const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");
  formData.push({ name: csrfName, value: csrfHash });

  $.ajax({
    url: BaseUrlJsQ + "admin/presensi/store",
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
        $("#f_aP1")[0].reset();
      } else {
        toastr.error(response.pesan, "Error", {
          timeOut: 3000,
        });
      }
      $("#moP").modal("hide");
      x01_.ajax.reload();
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
function exis() {
  $("#x01_").on("click", "span", function () {
    var tr = $(this).closest("tr");
    var data = x01_.row(tr).data();
    if (tr.hasClass("child")) {
      tr = tr.prev();
      data = x01_.row(tr).data();
    }
    if ($(this).hasClass("btn-delete")) {
      dell(data.id);
    } else if ($(this).hasClass("btn-edit")) {
      $("#moP").modal("show");
      $("#id").val(data.id);
      $("#nama").val(data.nama);
      $("#kode_absen").val(data.kode_absen);
      $("#dev_id").val(data.dev_id);
      $("#status").val(data.status);
      $("#tgl_mulai").val(data.tgl_mulai);
      $("#tgl_akhir").val(data.tgl_akhir);
    }
  });
}
function dell(id) {
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
        url: BaseUrlJsQ + "admin/presensi/dell",
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
            x01_.ajax.reload();
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
