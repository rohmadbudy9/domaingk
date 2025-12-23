$(function () {
  $(".masuk_").on("click", function () {
    dilivery("Masuk");
  });
  $(".pulang_").on("click", function () {
    dilivery("Pulang");
  });
  if (typeof NIP !== "undefined" && NIP) {
    loadRiwayat(NIP);
  }
  setupSimulasiPoin();
});

function dilivery(tipe) {
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
    tipe: tipe,
    kode_absen: Kode_Absen,
    [csrfName]: csrfHash,
  };
  $.ajax({
    url: BaseUrlJsQ + "go",
    type: "POST",
    dataType: "JSON",
    data: data,
    success: function (response) {
      Swal.close();
      if (response.status) {
        $('meta[name="csrf-token-hash"]').attr("content", response.csrf_baru);
        Swal.fire({
          title: "Berhasil!",
          text: response.pesan,
          icon: "success",
        });
        if (typeof NIP !== "undefined" && NIP) {
          loadRiwayat(NIP);
        }
      } else {
        $('meta[name="csrf-token-hash"]').attr("content", response.csrf_baru);
        Swal.fire({
          title: "Gagal!",
          text: response.pesan,
          icon: "error",
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
      Swal.fire({
        title: "Gagal!",
        text: errors,
        icon: "error",
      });
    },
  });
}
function loadRiwayat(nip) {
  const historyApiUrl =
    "https://mpresensi.gunungkidulkab.go.id/api/index.php/gethistory/" + nip;
  const $tbody = $("#tbHistori tbody");
  $tbody.html(
    '<tr><td colspan="5" style="text-align: center;">Mengambil data riwayat...</td></tr>'
  );
  $.ajax({
    url: historyApiUrl,
    type: "GET",
    dataType: "JSON",
    success: function (response) {
      if (
        response.message === "success" &&
        response.data &&
        response.data.length > 0
      ) {
        $tbody.empty();
        const dataTerbatas = response.data.slice(0, 5);

        $.each(dataTerbatas, function (index, item) {
          const waktuFull = new Date(item.presensi_waktu);
          const tgl = waktuFull.toLocaleDateString("id-ID", {
            weekday: "short",
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
          });
          const waktu = waktuFull.toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
          });
          const statusIcon =
            item.presensi_dikoreksi === "N"
              ? '<i class="fa fa-check" style="color: green;" title="Terkoreksi"></i>'
              : "-";
          const row = `
                <tr>
                    <td class="pricing-one__text">${tgl}</td>
                    <td class="pricing-one__text">${item.presensi_jenis}</td>
                    <td class="pricing-one__text">${waktu}</td>
                    <td class="pricing-one__text">${item.presensi_jarak}</td>
                    <td class="pricing-one__text" style="text-align: center;">${statusIcon}</td>
                </tr>
            `;
          $tbody.append(row);
        });
      } else {
        $tbody.html(
          '<tr><td colspan="5" style="text-align: center;">Riwayat presensi masih kosong.</td></tr>'
        );
      }
    },
    error: function (jqXHR) {
      $tbody.html(
        '<tr><td colspan="5" style="text-align: center; color: red;">Gagal memuat riwayat. Coba refresh halaman.</td></tr>'
      );
    },
  });
}
let totalPoinSimulasi = 0.0;
let daftarPekerjaanMap = new Map();
function setupSimulasiPoin() {
  if (typeof BUKU_KERJA_DATA !== "undefined" && BUKU_KERJA_DATA.length > 0) {
    BUKU_KERJA_DATA.forEach((item) => {
      daftarPekerjaanMap.set(item.nama_pekerjaan, parseFloat(item.poin));
    });
  }
  $("#btn-tambah-poin").click(function () {
    tambahPekerjaanSimulasi();
  });
  $("#tabel-simulasi tbody").on("click", ".btn-hapus-poin", function () {
    hapusPekerjaanSimulasi(this);
  });
}

function tambahPekerjaanSimulasi() {
  const namaPekerjaan = $("#input-pekerjaan").val();
  const jumlah = parseFloat($("#input-jumlah").val());
  if (
    !namaPekerjaan ||
    !daftarPekerjaanMap.has(namaPekerjaan) ||
    isNaN(jumlah) ||
    jumlah <= 0
  ) {
    Swal.fire({
      title: "Gagal!",
      text: "Pilih nama pekerjaan yang valid dari daftar dan masukkan jumlah yang benar.",
      icon: "error",
    });
    return;
  }

  const poin = daftarPekerjaanMap.get(namaPekerjaan);
  const subtotal = poin * jumlah;
  const row = `
        <tr data-subtotal="${subtotal}">
            <td class="pricing-one__text" style="font-size: 12px; white-space: normal;">${namaPekerjaan}</td>
            <td class="pricing-one__text">${jumlah}</td>
            <td class="pricing-one__text">${subtotal.toFixed(2)}</td>
            <td>
                <button class="btn btn-danger btn-sm btn-hapus-poin" title="Hapus">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        </tr>
    `;

  $("#tabel-simulasi tbody").append(row);
  totalPoinSimulasi += subtotal;
  updateTotalPoinDisplay();
  $("#input-pekerjaan").val("");
  $("#input-jumlah").val(1);
}

function hapusPekerjaanSimulasi(button) {
  const $row = $(button).closest("tr");
  const subtotal = parseFloat($row.data("subtotal"));
  totalPoinSimulasi -= subtotal;
  updateTotalPoinDisplay();
  $row.remove();
}

function updateTotalPoinDisplay() {
  $("#total-poin-display").text(totalPoinSimulasi.toFixed(2));
}
