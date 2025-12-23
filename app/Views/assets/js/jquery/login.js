$(document).ready(function () {
  ButtonExis();
});

function ButtonExis() {
  $("#loginbtn").on("click", function () {
    login();
  });
}

function login() {
  console.log("d");
  var errorDiv = $("#pesan_error");
  const data = $("#formLogin").serializeArray();
  const csrfName = $('meta[name="csrf-token-name"]').attr("content");
  const csrfHash = $('meta[name="csrf-token-hash"]').attr("content");
  data.push({ name: csrfName, value: csrfHash });

  errorDiv.addClass("d-none");
  $.ajax({
    url: BaseUrlJsQ + "trxlogin",
    type: "POST",
    dataType: "JSON",
    data: $.param(data),
    success: function (response) {
      if (response.Pesan_kirimke_ajax) {
        window.location.href = response.lempar_ke_url;
        return;
      }
      $('meta[name="csrf-token-hash"]').attr("content", response.csrf_baru);
      if (response.status) {
        window.location.href = response.ke_route;
      } else {
        if (response.jumlah_kegagalan) {
          response.pesan +=
            "<br><small>Percobaan gagal: " +
            response.jumlah_kegagalan +
            " kali.</small>";
        }
        $("#pesan_error").html(response.pesan).removeClass("d-none");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      if (
        jqXHR.responseText &&
        (jqXHR.responseText.includes("<!DOCTYPE html>") ||
          jqXHR.responseText.includes("<html>"))
      ) {
        document.open();
        document.write(jqXHR.responseText);
        document.close();
      } else {
        errorDiv
          .html("Terjadi kesalahan. Silakan hubungi administrator.")
          .removeClass("d-none");
      }
    },
  });
}
