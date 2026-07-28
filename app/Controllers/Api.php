<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    // Method ini menangkap nama kecamatan dari URL
    public function artikel($kecamatan = null)
    {
        // 1. Validasi nama kecamatan agar aman dari injeksi nama database aneh
        $daftar_kecamatan = [
            'gedangsari',
            'girisubo',
            'karangmojo',
            'ngawen',
            'nglipar',
            'paliyan',
            'panggang',
            'patuk',
            'playen',
            'ponjong',
            'purwosari',
            'rongkop',
            'saptosari',
            'semanu',
            'semin',
            'tanjungsari',
            'tepus',
            'wonosari'
        ];

        if (!in_array($kecamatan, $daftar_kecamatan)) {
            return $this->failNotFound('Kecamatan tidak terdaftar.');
        }

        // 2. Ambil parameter tanggal dari URL jika ada (contoh: ?dari=2026-07-01&ke=2026-07-31)
        $dari = $this->request->getGet('dari');
        $ke   = $this->request->getGet('ke');

        // 3. Setup koneksi dinamis ke database spesifik
        $db_config = [
            'DBDriver' => 'MySQLi',
            'hostname' => '12.12.12.82', // Sesuaikan host database master
            'username' => 'cekdomain_new',      // Sesuaikan username
            'password' => 'Adalah123./',          // Sesuaikan password
            'database' => 'gnkab_01' . $kecamatan, // Nama database dinamis!
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => false, // Matikan debug agar JSON tidak rusak jika error
            'charset'  => 'utf8',
            'DBCollat' => 'utf8_general_ci',
        ];

        try {
            $db = \Config\Database::connect($db_config, false);

            if ($dari && $ke) {
                $sql = "SELECT COUNT(judul) AS jumlah, SUM(dibaca) AS total_baca 
                        FROM tbl_artikel 
                        WHERE create_at BETWEEN ? AND ?";
                $binds = [$dari . ' 00:00:00', $ke . ' 23:59:59'];
                $query = $db->query($sql, $binds)->getRow();
            } else {
                $sql = "SELECT COUNT(judul) AS jumlah, SUM(dibaca) AS total_baca 
                        FROM tbl_artikel";
                $query = $db->query($sql)->getRow();
            }

            $db->close(); // Langsung tutup koneksi

            // 4. Format keluaran JSON
            $data = [
                'status'         => 200,
                'nama_kecamatan' => 'Kecamatan ' . ucfirst($kecamatan),
                'url_web'        => 'http://' . $kecamatan . '.gunungkidulkab.go.id/',
                'jumlah_artikel' => (int) $query->jumlah,
                'total_baca'     => (int) $query->total_baca,
                'periode'        => ($dari && $ke) ? "$dari s/d $ke" : "Semua Waktu"
            ];

            return $this->respond($data);
        } catch (\Exception $e) {
            // Kita keluarkan pesan error bawaan MySQL/CI4 untuk mencari tahu masalahnya
            return $this->failServerError('Detail Error MySQL: ' . $e->getMessage());
        }
    }
}
