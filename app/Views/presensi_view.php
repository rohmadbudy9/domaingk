<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 480px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 1.4rem;
            margin-bottom: 16px;
        }

        .info {
            margin-bottom: 20px;
            font-size: 1rem;
            color: #333;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 16px;
            margin-bottom: 16px;
            font-size: 1.2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-masuk {
            background-color: #28a745;
            color: white;
        }

        .btn-masuk:hover {
            background-color: #218838;
        }

        .btn-pulang {
            background-color: #ffc107;
            color: black;
        }

        .btn-pulang:hover {
            background-color: #e0a800;
        }

        /* START OF NEW CODE: Warna Merah untuk Dinas */
        .btn-dinas {
            background-color: #dc3545;
            /* Merah */
            color: white;
        }

        .btn-dinas:hover {
            background-color: #c82333;
        }

        /* END OF NEW CODE */

        .btn-poin {
            background-color: #3f3ffaff;
            color: white;
        }

        .btn-poin:hover {
            background-color: #3f3ffaff;
        }

        img.img-responsive {
            max-width: 100%;
            height: auto;
            border: 2px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
        }

        /* Styling untuk form dinas */
        .form-dinas {
            text-align: left;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
            background-color: #f9f9f9;
        }

        .form-dinas label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        .form-dinas input,
        .form-dinas textarea {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-dinas button {
            margin-top: 15px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="info">
            <div style="
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        border: 1px solid #ccc; /* Border opsional */
        padding: 5px 0;
        margin-top: 5px;
        background-color: #f9f9f9;">
                <p style="
            display: inline-block;
            padding-left: 100%; /* Memastikan teks mulai dari luar batas kanan */
            animation: marquee 15s linear infinite; /* Kunci animasi */
            font-weight: bold;
            color: #d35400; /* Warna teks */
            margin: 0;
        ">
                    ✨ Dukung Rudycode di https://saweria.co/Rudycode | Terima kasih untuk setiap dukungan! ✨
                </p>
            </div>
        </div>
        <div style="color: #ff0000ff;
        border: 1px solid #000000ff; /* Border opsional */
        ">
            Link Presensi ini akan dihapus pada : <strong> Rabu 05 November 2025 Pukul 09:00 WIB, </strong>setelah itu link tidak bisa digunakan lagi secara permanen, mohon hubungi admin jika ingin mendapat link terbaru, terimakasih
        </div>
        <h2>
            SELAMAT DATANG
        </h2>
        <div class="info"> <strong id="namapns">Memuat...</strong></div>
        <div class="info">Device ID: <strong><?= htmlspecialchars($devid) ?></strong></div>
        <div class="info">Waktu Sekarang: <strong id="waktu">--:--:--</strong></div>

        <h3>Mau</h3>
        <button class="btn btn-masuk presensi-btn" data-tipe="Masuk">👷 Masuk</button>
        <h3>Atau</h3>
        <button class="btn btn-pulang presensi-btn" data-tipe="Pulang">🏠 Pulang</button>
        <h3>Atau Malah Sekarang Baru</h3>
        <button class="btn btn-dinas" id="btn-show-dinas">✈️ Presensi Dinas</button>
        <div id="form-dinas-container" class="form-dinas" style="display:none;">
            <h4>Input Presensi Dinas</h4>
            <div id="dinas-info" style="margin-bottom:10px;color:#dc3545;">Mohon masukkan koordinat dan keterangan tugas.</div>

            <label for="dinas-posisi">Latitude, Longitude (Contoh: -8.7367815,115.1659639):</label>
            <input type="text" id="dinas-posisi" placeholder="Koordinat Posisi Anda" value="">

            <label for="dinas-keterangan">Keterangan/Tujuan Dinas (Wajib Diisi):</label>
            <textarea id="dinas-keterangan" placeholder="Contoh: Migrasi Server Colocation"></textarea>

            <button class="btn btn-dinas" id="btn-send-dinas" data-tipe="Dinas">Kirim Presensi Dinas</button>
        </div>
        <h3>Atau Cobain Fitur Baru</h3>
        <button class="btn btn-poin" onclick="window.location.href='https://kominfo.gunungkidulkab.go.id/poinbukukerja'"> 🧮 Kalkulasi Poin Buku Kerja </button>
        <h3>Iklan</h3>
        <img src="/application/views/saweria.png" alt="Iklan" class="img-responsive" />

        <div style="margin-top: 15px; text-align: center;">
            <a href="https://saweria.co/rudycode"
                target="_blank"
                style="
           display: inline-block;
           padding: 10px 20px;
           background-color: #f1c40f; /* Warna Saweria, bisa disesuaikan */
           color: #2c3e50; /* Warna teks gelap */
           text-decoration: none;
           border-radius: 5px;
           font-weight: bold;
           border: 1px solid #f39c12;
           transition: background-color 0.3s ease;
       "
                onmouseover="this.style.backgroundColor='#f39c12'"
                onmouseout="this.style.backgroundColor='#f1c40f'">
                💸 Dukung Kami di Saweria 💸
            </a>
        </div>

        <h3>Riwayat Presensi Anda</h3>
        <div id="riwayat-presensi">Memuat riwayat...</div>

        <div style="margin-top: 20px; font-size: 0.9rem; color: #888;">
            made with ❤️ by <a href="https://github.com/rohmadbudy9" target="_blank" style="text-decoration:none;color:#555;">@RudyCode</a>
        </div>

    </div>


    <script>
        // Fungsi tampilkanWaktuSinkron dan randomOffset tetap
        function tampilkanWaktuSinkron(baseTime) {
            const baseClient = Date.now();

            function render() {
                const now = new Date(baseTime.getTime() + (Date.now() - baseClient));
                const jam = now.getHours().toString().padStart(2, '0');
                const menit = now.getMinutes().toString().padStart(2, '0');
                const detik = now.getSeconds().toString().padStart(2, '0');
                $("#waktu").text(`${jam}:${menit}:${detik}`);
            }
            render();
            setInterval(render, 1000);
        }

        function randomOffset(minMeter = 5, maxMeter = 50) {
            const angle = Math.random() * 2 * Math.PI;
            const distance = minMeter + Math.random() * (maxMeter - minMeter);
            const deltaDeg = distance / 111000;
            return {
                dx: Math.cos(angle) * deltaDeg,
                dy: Math.sin(angle) * deltaDeg,
                distance: distance
            };
        }

        // Fungsi hitungJarakMeter (Haversine) tetap
        function hitungJarakMeter(lat1, lon1, lat2, lon2) {
            const R = 6371000;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        $(document).ready(function() {
            console.log("Browser Timezone:", Intl.DateTimeFormat().resolvedOptions().timeZone);

            const devid = "<?= $devid ?>";
            const apiBase = "https://mpresensi.gunungkidulkab.go.id/api/index.php/";
            let biodata = {};

            // === fungsi fetch dengan retry & timeout === (tetap)
            function fetchWithRetry(url, maxRetry = 3, delay = 2000) {
                return new Promise((resolve, reject) => {
                    const attempt = (n) => {
                        $.ajax({
                            url: url,
                            dataType: "json",
                            timeout: 7000, // 7 detik timeout
                            success: resolve,
                            error: (xhr, status) => {
                                console.warn(`Gagal load ${url} (percobaan ke-${maxRetry - n + 1}):`, status);
                                if (n === 0) reject(status);
                                else setTimeout(() => attempt(n - 1), delay);
                            }
                        });
                    };
                    attempt(maxRetry);
                });
            }

            const apiUrl = apiBase + "cekdevice/" + devid;
            $("#namapns").text("Memuat data dari server...");
            $("#waktu").text("--:--:--");
            $("#riwayat-presensi").html("<p>Sedang memuat riwayat...</p>");

            fetchWithRetry(apiUrl)
                .then(resp => {
                    if (!resp || !resp.data) throw new Error("Data kosong dari server");
                    biodata = resp.data;
                    $("#namapns").text(biodata.namapns || "-");

                    const saikiStr = biodata.saiki;
                    if (saikiStr) {
                        const baseTime = new Date(saikiStr.replace(" ", "T"));
                        if (!isNaN(baseTime.getTime())) {
                            tampilkanWaktuSinkron(baseTime);
                        }
                    }

                    const nip = biodata.biodata_nip;
                    if (!nip) {
                        $("#riwayat-presensi").html("<p>NIP tidak ditemukan di server.</p>");
                        return null;
                    }

                    const urlRiwayat = apiBase + "gethistory/" + nip;
                    return fetchWithRetry(urlRiwayat);
                })
                .then(data => {
                    if (!data) return; // sudah ditangani di atas
                    if (data.message === "success" && data.data.length > 0) {
                        let table = "<table style='width:100%;border-collapse:collapse;margin-top:20px;font-family:sans-serif;font-size:14px;'>" +
                            "<thead><tr style='background:#f0f0f0;text-align:left;'>" +
                            "<th style='padding:8px;'>Tanggal</th>" +
                            "<th style='padding:8px;'>Jenis</th>" +
                            "<th style='padding:8px;'>Waktu</th>" +
                            "<th style='padding:8px;'>Jarak</th>" +
                            "<th style='padding:8px;'>Status</th>" +
                            "</tr></thead><tbody>";

                        data.data.forEach((item) => {
                            const waktu = item.presensi_waktu.split(" ");
                            const tanggal = waktu[0];
                            const jam = waktu[1];
                            const dateObj = new Date(`${tanggal}T${jam}`);
                            const hari = new Intl.DateTimeFormat('id-ID', {
                                weekday: 'long'
                            }).format(dateObj);
                            const status = item.presensi_dikoreksi === "Y" ?
                                "<span style='color:red'>❌ Dibatalkan</span>" :
                                "<span style='color:green'>✅ OK</span>";
                            const warna = item.presensi_jenis === "Masuk" ? "#ffffff" : "#e6f2ff";

                            table += `<tr style="background:${warna};">
                            <td style="padding:8px;">${hari}, ${tanggal}</td>
                            <td style="padding:8px;">${item.presensi_jenis}</td>
                            <td style="padding:8px;">${jam}</td>
                            <td style="padding:8px;">${item.presensi_jarak}</td>
                            <td style="padding:8px;">${status}</td>
                        </tr>`;
                        });

                        table += "</tbody></table>";
                        $("#riwayat-presensi").html(table);
                    } else {
                        $("#riwayat-presensi").html("<p>Tidak ada riwayat presensi ditemukan.</p>");
                    }
                })
                .catch(err => {
                    console.error("Kesalahan saat memuat data:", err);
                    $("#namapns").text("Gagal mengambil data");
                    $("#waktu").text("--:--:--");
                    $("#riwayat-presensi").html("<p>Server sibuk atau jaringan lambat. Silakan coba lagi nanti.</p>");
                });

            // === Tombol presensi Harian (Masuk/Pulang) ===
            $(".presensi-btn").click(function() {
                if (!biodata || !biodata.token) {
                    alert("Data belum siap. Silakan tunggu.");
                    return;
                }

                const tipe = $(this).data("tipe");
                const token = biodata.token;
                const nip = biodata.biodata_nip;
                const nama = biodata.namapns;
                const lat = parseFloat(biodata.lat);
                const lon = parseFloat(biodata.lon);
                const offset = randomOffset(5, 50);
                const x = lat + offset.dy;
                const y = lon + offset.dx;
                const latlon = `${x.toFixed(7)},${y.toFixed(7)}`;
                const jarak = (Math.floor(hitungJarakMeter(lat, lon, x, y))) + "m";

                const urlPresensi = `${apiBase}presensi/${nip}/${tipe}/${latlon}/${jarak}/-/${token}`;

                const konfirmasi = confirm(
                    `NIP: ${nip}\n` +
                    `Nama: ${nama}\n` +
                    `Token: ${token}\n` +
                    `Posisi: ${latlon}\n` +
                    `Tipe: ${tipe}\n` +
                    `Jarak: ${jarak}\n\n` +
                    `Yakin mau presensi?`
                );

                if (konfirmasi) {
                    $.post(urlPresensi, {
                        value: 1
                    }, function(response) {
                        const motivasiList = [
                            // ... (Daftar motivasi tetap) ...
                            "Mantap bosku! 💪 Saatnya cari rejeki halal 😎",
                            "Absen done, tinggal ngopi dulu boleh lah ☕😄",
                            "Kerja boleh santai, asal target tercapai 🛠️🔥",
                            "Presensi sukses! Gaji makin dekat 💸🤭",
                            "Semangat yaa, jangan kebanyakan scroll IG 😅",
                            "Ayo kerja biar bisa liburan tiap minggu 🤣🏖️",
                            "Kerja keras dulu, rebahan nanti 🛌😂",
                            "Kerja itu ibadah, jangan sambil ngantuk aja 😴✋",
                            "Jangan lupa senyum walau banyak deadline 😬",
                            "Gaji bukan segalanya, tapi segalanya butuh gaji 😅",
                            "Kamu luar biasa! Tapi jangan kebanyakan main game dulu 🎮",
                            "Hidupmu bukan cuma kerja... tapi kerja dulu gapapa lah 😆",
                            "Jangan baper kalau kerjaan banyak, itu tandanya dipercaya 💼❤️",
                            "Kerja keras hari ini adalah kesuksesan esok hari! 💡",
                            "Setiap langkah kecil hari ini, adalah lompatan besar nanti. 🛠️",
                            "Tidak ada hasil tanpa usaha 💪",
                            "Semangat terus, jangan menyerah! 🔥",
                            "Presensi dulu, urusan duniawi belakangan 😎🌍",
                            "Kehidupan nyata dimulai setelah absen 😆",
                            "Absensi bukan segalanya, tapi tanpa absensi gaji bisa dipotong! 🫥",
                            "Absen sukses! Saatnya pura-pura sibuk 🫣💼",
                            "Sudah absen, tinggal cari colokan buat ngecas hidup 🔌😅",
                            "Gaji makin deket, mood kerja makin menjauh 🤖💸",
                            "Kerja keras biar bisa beli kopi mahal ☕💸",
                            "Ingat, setiap absen membawa kita lebih dekat ke tanggal tua 😅📆",
                            "Kerja itu ibadah... tapi rebahan juga sunnah 🙃🛌",
                            "Absen berhasil, sekarang tinggal tunggu gaji & cuti 🎯😴",
                            "Absen jalan terus, semangat kadang nyasar 🧭😂",
                            "Jangan stres, yang penting sudah absen 😎✔️",
                            "Sudah absen! Mari kita taklukkan pekerjaan hari ini dengan senyum dan kopi. ☕",
                            "Absen ✔️. Sekarang waktunya berjuang demi masa depan dan cicilan. 🤣",
                            "Kerja boleh lelah, tapi jangan sampai rezeki hilang. 💪",
                            "Hidup itu seperti absensi, harus dijalani. Kerja keras biar bisa liburan ke Bali! ✈️",
                            "Kerja itu panggilan, tapi gaji itu tujuan. 💸",
                            "Sudah absen, artinya sudah siap menghadapi kenyataan. 🫣",
                            "Absen sukses! Sekarang tinggal fokus, biar cepat pulang dan rebahan. 🛌",
                            "Ingat, setiap presensi adalah investasi untuk masa depan. 💰",
                            "Presensi selesai! Saatnya bekerja dengan senyum, biar cepat dapat THR. 🤩",
                            "Kerja keras itu wajib, tapi istirahat itu perlu. Jangan lupa bahagiakan diri sendiri! ❤️",
                        ];
                        alert("Presensi berhasil!\n\n" + motivasiList[Math.floor(Math.random() * motivasiList.length)]);

                        const now = new Date();
                        const waktuWIB = now.toLocaleString("sv-SE", {
                            timeZone: "Asia/Jakarta"
                        }).replace(" ", "T");

                        $.post("https://kominfo.gunungkidulkab.go.id/logpresensi/simpan", {
                            nip,
                            nama,
                            tipe,
                            latlon,
                            jarak,
                            devid,
                            waktu: waktuWIB
                        }).always(() => {
                            setTimeout(() => location.reload(), 300);
                        });
                    }).fail(function() {
                        alert("Gagal mengirim presensi.");
                    });
                }
            });

            // START OF NEW CODE: Logic untuk Presensi Dinas
            $("#btn-show-dinas").click(function() {
                $("#form-dinas-container").toggle();
            });

            $("#btn-send-dinas").click(function() {
                if (!biodata || !biodata.token) {
                    alert("Data belum siap. Silakan tunggu.");
                    return;
                }

                const tipe = $(this).data("tipe"); // Harusnya "Dinas"
                const token = biodata.token;
                const nip = biodata.biodata_nip;
                const nama = biodata.namapns;
                const latlonInput = $("#dinas-posisi").val().trim();
                const keteranganInput = $("#dinas-keterangan").val().trim();
                const latReguler = parseFloat(biodata.lat);
                const lonReguler = parseFloat(biodata.lon);

                // --- VALIDASI INPUT ---
                if (!latlonInput || !keteranganInput) {
                    alert("Koordinat dan Keterangan wajib diisi untuk Presensi Dinas.");
                    return;
                }

                const [latPresensi, lonPresensi] = latlonInput.split(',').map(s => s.trim());
                if (isNaN(parseFloat(latPresensi)) || isNaN(parseFloat(lonPresensi))) {
                    alert("Format koordinat tidak valid. Gunakan format Lintang,Bujur (Contoh: -8.7367815,115.1659639).");
                    return;
                }

                // Konversi dan hitung jarak
                const latPresensiFloat = parseFloat(latPresensi);
                const lonPresensiFloat = parseFloat(lonPresensi);

                const jarakMentah = hitungJarakMeter(latReguler, lonReguler, latPresensiFloat, lonPresensiFloat);

                // Format jarak sesuai logika yang kita bahas (XX.XX km atau XX m)
                const jarakDisplay = (jarakMentah > 1000) ?
                    (Number(jarakMentah / 1000).toFixed(2) + " km") :
                    (Math.floor(jarakMentah) + "m");

                // URL Encoding untuk Posisi (lintang,bujur) dan Keterangan
                const latlonEncoded = encodeURIComponent(latlonInput.replace(/\s/g, ''));
                const ketEncoded = encodeURIComponent(keteranganInput);

                // FINAL URL
                // URL: .../presensi/{nip}/{Dinas}/{latlon_dinas}/{jarak_display}/{keterangan_dinas}/{token}
                const urlPresensiDinas = `${apiBase}presensi/${nip}/${tipe}/${latlonEncoded}/${jarakMentah}/${ketEncoded}/${token}`;


                const konfirmasiDinas = confirm(
                    `-- KONFIRMASI PRESENSI DINAS --\n` +
                    `NIP: ${nip}\n` +
                    `Tipe: ${tipe}\n` +
                    `Posisi: ${latlonInput}\n` +
                    `Jarak ke Kantor: ${jarakDisplay}\n` +
                    `Keterangan: ${keteranganInput}\n\n` +
                    `Yakin kirim presensi dinas?`
                );

                if (konfirmasiDinas) {
                    $.post(urlPresensiDinas, {
                        value: 1
                    }, function(response) {
                        alert("Presensi Dinas berhasil dikirim!");

                        // Log Presensi Dinas (sesuaikan dengan log harian)
                        const now = new Date();
                        const waktuWIB = now.toLocaleString("sv-SE", {
                            timeZone: "Asia/Jakarta"
                        }).replace(" ", "T");

                        $.post("https://kominfo.gunungkidulkab.go.id/logpresensi/simpan", {
                            nip,
                            nama,
                            tipe, // "Dinas"
                            latlon: latlonInput,
                            jarak: jarakDisplay,
                            keterangan: keteranganInput, // Tambahkan keterangan ke log jika perlu
                            devid,
                            waktu: waktuWIB
                        }).always(() => {
                            setTimeout(() => location.reload(), 300);
                        });

                    }).fail(function() {
                        alert("Gagal mengirim Presensi Dinas. Cek format koordinat dan koneksi.");
                    });
                }
            });
            // END OF NEW CODE: Logic untuk Presensi Dinas
        });
    </script>
    <style>
        /* KODE CSS: Definisikan animasi pergerakan teks */
        @keyframes marquee {
            0% {
                transform: translate(0, 0);
                /* Posisi awal: di luar batas kanan */
            }

            100% {
                transform: translate(-100%, 0);
                /* Posisi akhir: bergerak ke kiri */
            }
        }
    </style>


</body>

</html>