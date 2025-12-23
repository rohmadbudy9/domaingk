if (WaktuTerkunci) {
  const hitungmundur = document.getElementById("hitungmundur");
  const kembalikeLogin = document.getElementById("kembaliKeHalamanLogin");
  const timer = setInterval(function () {
    const waktutunggu = Math.round(WaktuTerkunci - new Date().getTime() / 1000);

    if (waktutunggu <= 0) {
      clearInterval(timer);
      hitungmundur.innerHTML = "Anda sudah bisa mencoba login kembali.";
      kembalikeLogin.classList.remove("d-none");
    } else {
      const menit = Math.floor(waktutunggu / 60);
      const detik = waktutunggu % 60;
      hitungmundur.innerHTML =
        "Sisa waktu: " +
        String(menit).padStart(2, "0") +
        ":" +
        String(detik).padStart(2, "0");
    }
  }, 1000);
}
