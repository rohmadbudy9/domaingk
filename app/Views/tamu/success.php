<!DOCTYPE html>
<html>

<head>
    <title>Registrasi Berhasil</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            margin-top: 80px;
        }

        .ticket {
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
        }

        a {
            padding: 10px 20px;
            background: green;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <h2>✅ Registrasi Berhasil</h2>

    <p>Nomor Tiket Kunjungan Anda:</p>
    <div class="ticket"><?= esc($nomor_tiket) ?></div>

    <a href="<?= base_url('tamu/exportPDF/' . $tamu_id) ?>">
        Download PDF
    </a>

</body>

</html>