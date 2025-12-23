<!DOCTYPE html>
<html>

<head>
    <title>Review Data Kunjungan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background: #eee;
            width: 30%;
        }

        h3 {
            text-align: center;
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        img {
            max-width: 150px;
        }
    </style>
</head>

<body>

    <h3>Review Data Kunjungan</h3>

    <table>
        <tr>
            <th>Lokasi DC</th>
            <td><?= esc($form['lokasi_dc']) ?></td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td><?= esc($form['kategori_keperluan']) ?></td>
        </tr>
        <tr>
            <th>Keperluan</th>
            <td><?= esc($form['keperluan']) ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?= esc($form['nama']) ?></td>
        </tr>
        <tr>
            <th>Asal</th>
            <td><?= esc($form['asal']) ?></td>
        </tr>
        <tr>
            <th>No HP</th>
            <td><?= esc($form['nomor_hp']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= esc($form['email']) ?></td>
        </tr>
        <tr>
            <th>Jumlah Orang</th>
            <td><?= esc($form['jumlah']) ?></td>
        </tr>
        <tr>
            <th>Aktivitas</th>
            <td><?= esc($form['aktivitas']) ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?= esc($form['tanggal_kedatangan']) ?></td>
        </tr>
        <tr>
            <th>Waktu</th>
            <td><?= esc($form['waktu_kedatangan']) ?></td>
        </tr>
    </table>

    <?php if (!empty($personel)): ?>
        <h4>Personel Tambahan</h4>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No HP</th>
            </tr>
            <?php foreach ($personel as $i => $p): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($p['nama']) ?></td>
                    <td><?= esc($p['nomor_hp']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <h4>Lampiran</h4>
    <table>
        <tr>
            <th>Foto Diri</th>
            <th>Foto KTP</th>
        </tr>
        <tr>
            <td><img src="<?= base_url($foto_diri) ?>"></td>
            <td><img src="<?= base_url($foto_ktp) ?>"></td>
        </tr>
    </table>

    <div class="actions">
        <form action="<?= base_url('tamu/submitFinal') ?>" method="post">
            <?= csrf_field() ?>
            <button type="submit">✅ Submit Final</button>
        </form>

        <br>

        <a href="<?= base_url('tamu/addtamu') ?>">🔙 Kembali Edit</a>
    </div>

</body>

</html>