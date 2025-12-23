$(document).ready(function () {
  initButton();
});

function initButton() {
  $("#icons").on("click", ".row > div", function () {
    const iconClass = $(this).text().trim();
    if (iconClass) {
      navigator.clipboard
        .writeText(iconClass)
        .then(() => {
          if (typeof toastr !== "undefined") {
            toastr.success('"' + iconClass + '" berhasil disalin!', "Copied");
          } else {
            const originalContent = $(this).html();
            $(this).html(
              '<span style="color: #0acf97; font-weight: bold;">Copied!</span>'
            );
            setTimeout(() => {
              $(this).html(originalContent);
            }, 1200);
          }
        })
        .catch((err) => {
          console.error("Gagal menyalin ikon: ", err);
          if (typeof toastr !== "undefined") {
            toastr.error("Gagal menyalin.", "Error");
          }
        });
    }
  });
}
