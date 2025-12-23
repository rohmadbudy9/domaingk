<!DOCTYPE html>
<html>

<head>
    <title>Form Kunjungan Data Center</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        h2,
        h3 {
            text-align: center;
        }

        .section-title {
            background: #ddd;
            padding: 6px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>Formulir Kunjungan Data Center</h2>
    <h3>Pemerintah Kabupaten Gunungkidul</h3>

    <div class="section-title">Informasi Tamu</div>
    <table>
        <tr>
            <th>Nomor Tiket Kunjungan</th>
            <td><?= esc($tamu['nomor_tiket']) ?></td>
        </tr>
        <tr>
            <th>Lokasi Data Center</th>
            <td><?= esc($tamu['lokasi_dc']) ?></td>
        </tr>
        <tr>
            <th>Kategori Keperluan</th>
            <td><?= esc($tamu['kategori_keperluan']) ?></td>
        </tr>
        <tr>
            <th>Keperluan</th>
            <td><?= esc($tamu['keperluan']) ?></td>
        </tr>
        <tr>
            <th>Nama Tamu</th>
            <td><?= esc($tamu['nama']) ?></td>
        </tr>
        <tr>
            <th>Asal Instansi</th>
            <td><?= esc($tamu['asal']) ?></td>
        </tr>
        <tr>
            <th>No. HP / WA</th>
            <td><?= esc($tamu['nomor_hp']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= esc($tamu['email']) ?></td>
        </tr>
        <tr>
            <th>Jumlah Orang</th>
            <td><?= esc($tamu['jumlah']) ?></td>
        </tr>
        <tr>
            <th>Aktivitas</th>
            <td><?= esc($tamu['aktivitas']) ?></td>
        </tr>
        <tr>
            <th>Tanggal Kedatangan</th>
            <td><?= esc($tamu['tanggal_kedatangan']) ?></td>
        </tr>
        <tr>
            <th>Waktu Kedatangan</th>
            <td><?= esc($tamu['waktu_kedatangan']) ?></td>
        </tr>
    </table>

    <br>

    <div class="section-title">Personel Tambahan</div>

    <?php if (!empty($personel)): ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Personel</th>
                    <th>Nomor HP</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($personel as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($p->nama) ?></td>
                        <td><?= esc($p->nomor_hp) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada personel tambahan.</p>
    <?php endif; ?>

    <br>

    <div class="section-title">Lampiran Foto</div>

    <table>
        <tr>
            <th>Foto Diri</th>
            <th>Foto KTP / ID</th>
        </tr>
        <tr>
            <td>
                <?php if ($tamu['foto_diri']): ?>
                    <img src="<?= base_url('uploads/foto_diri/' . $tamu['foto_diri']) ?>" width="150">
                <?php endif; ?>
            </td>
            <td>
                <?php if ($tamu['foto_ktp']): ?>
                    <img src="<?= base_url('uploads/foto_ktp/' . $tamu['foto_ktp']) ?>" width="150">
                <?php endif; ?>
            </td>
        </tr>
    </table>

</body>

</html>