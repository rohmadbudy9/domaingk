<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    public function __construct()
    {
        // Mengizinkan akses dari semua domain (tanda * berarti semua diizinkan)
        header('Access-Control-Allow-Origin: *');

        // Mengizinkan metode request standar
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');

        // Mengizinkan tipe header tertentu
        header('Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding, Authorization');

        // Menangani pre-flight request dari browser
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit(0);
        }
    }
    // Method ini menangkap nama kecamatan dari URL
    public function artikel($kecamatan = null)
    {
        // 1. Mapping nama di URL dengan nama Database yang tepat
        $daftar_kecamatan = [
            'gedangsari'  => 'gnkab_01gedangsari',
            'girisubo'    => 'gnkab_02girisubo',
            'karangmojo'  => 'gnkab_03karangmojo',
            'ngawen'      => 'gnkab_04ngawen',
            'nglipar'     => 'gnkab_05nglipar',
            'paliyan'     => 'gnkab_06paliyan',
            'panggang'    => 'gnkab_07panggang',
            'patuk'       => 'gnkab_08patuk',
            'playen'      => 'gnkab_09playen',
            'ponjong'     => 'gnkab_10ponjong',
            'purwosari'   => 'gnkab_11purwosari',
            'rongkop'     => 'gnkab_12rongkop',
            'saptosari'   => 'gnkab_13saptosari',
            'semanu'      => 'gnkab_14semanu',
            'semin'       => 'gnkab_15semin',
            'tanjungsari' => 'gnkab_16tanjungsari',
            'tepus'       => 'gnkab_17tepus',
            'wonosari'    => 'gnkab_18wonosari'
        ];

        // Validasi: Cek apakah nama kecamatan dari URL ada di daftar "Key" array kita
        if (!array_key_exists($kecamatan, $daftar_kecamatan)) {
            return $this->failNotFound('Kecamatan tidak terdaftar.');
        }

        // Ambil nama database yang sesuai dari array
        $nama_database = $daftar_kecamatan[$kecamatan];

        // 2. Ambil parameter tanggal dari URL jika ada
        $dari = $this->request->getGet('dari');
        $ke   = $this->request->getGet('ke');

        // 3. Setup koneksi dinamis ke database spesifik
        $db_config = [
            'DBDriver' => 'MySQLi',
            'hostname' => '12.12.12.82',
            'username' => 'cekdomain_new',
            'password' => 'Adalah123./',
            'database' => $nama_database, // Menggunakan variabel mapping database!
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => false,
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
            return $this->failServerError('Detail Error MySQL: ' . $e->getMessage());
        }
    }
    // Method baru untuk mengambil isi artikel (bukan sekadar jumlah)
    public function daftar_berita($kecamatan = null)
    {
        $daftar_kecamatan = [
            'gedangsari'  => 'gnkab_01gedangsari',
            'girisubo'    => 'gnkab_02girisubo',
            'karangmojo'  => 'gnkab_03karangmojo',
            'ngawen'      => 'gnkab_04ngawen',
            'nglipar'     => 'gnkab_05nglipar',
            'paliyan'     => 'gnkab_06paliyan',
            'panggang'    => 'gnkab_07panggang',
            'patuk'       => 'gnkab_08patuk',
            'playen'      => 'gnkab_09playen',
            'ponjong'     => 'gnkab_10ponjong',
            'purwosari'   => 'gnkab_11purwosari',
            'rongkop'     => 'gnkab_12rongkop',
            'saptosari'   => 'gnkab_13saptosari',
            'semanu'      => 'gnkab_14semanu',
            'semin'       => 'gnkab_15semin',
            'tanjungsari' => 'gnkab_16tanjungsari',
            'tepus'       => 'gnkab_17tepus',
            'wonosari'    => 'gnkab_18wonosari'
        ];

        if (!array_key_exists($kecamatan, $daftar_kecamatan)) {
            return $this->failNotFound('Kecamatan tidak terdaftar.');
        }

        $nama_database = $daftar_kecamatan[$kecamatan];

        $db_config = [
            'DBDriver' => 'MySQLi',
            'hostname' => '12.12.12.82',
            'username' => 'cekdomain_new',
            'password' => 'Adalah123./',
            'database' => $nama_database,
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => false,
            'charset'  => 'utf8',
            'DBCollat' => 'utf8_general_ci',
        ];

        try {
            $db = \Config\Database::connect($db_config, false);

            // Menggunakan Query Builder CI4 untuk mengambil list artikel
            $builder = $db->table('tbl_artikel');

            // Pilih kolom yang ingin ditampilkan (sesuai struktur tabel Anda)
            $builder->select('id_artikel, judul, isi, gambar, create_at, update_at, judul_seo, publish');

            // Hanya ambil yang status publish = 'Y'
            $builder->where('publish', 'Y');

            // Urutkan dari berita terbaru
            $builder->orderBy('create_at', 'DESC');

            // Batasi misalnya hanya 10 artikel terbaru agar API tidak terlalu berat saat diakses
            $builder->limit(10);

            $query = $builder->get()->getResult();
            $db->close();

            $data = [
                'status'         => 200,
                'nama_kecamatan' => 'Kecamatan ' . ucfirst($kecamatan),
                'total_data'     => count($query),
                'artikel'        => $query // Ini akan menampilkan array berisi list berita
            ];

            return $this->respond($data);
        } catch (\Exception $e) {
            return $this->failServerError('Detail Error MySQL: ' . $e->getMessage());
        }
    }
}
