<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kecamatan extends BaseController
{
    public function index()
    {
        // Panggil data dari semua database CI3
        $data['hasil_evaluasi'] = $this->_get_data_kecamatan();

        // Di CI4, view di-return, bukan di-load
        return view('utama_kecamatan', $data);
    }

    public function cek()
    {
        // Di CI4, mengambil input POST
        $dr = $this->request->getPost('tgldr');
        $ke = $this->request->getPost('tglke');

        $data['hasil_evaluasi'] = $this->_get_data_kecamatan($dr, $ke);
        $data['dari'] = $dr;
        $data['ke']   = $ke;

        return view('utama_filter_kecamatan', $data);
    }

    // Fungsi pembantu untuk konek ke 18 database CI3 secara bergantian
    private function _get_data_kecamatan($tanggal_dari = null, $tanggal_ke = null)
    {
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

        $data_hasil = [];

        // Sesuaikan dengan user/pass database master di server Anda
        $db_config = [
            'DBDriver' => 'MySQLi',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'DBPrefix' => '',
            'pConnect' => false, // Harus false agar koneksi bisa ditutup
            'DBDebug'  => (ENVIRONMENT !== 'production'),
            'charset'  => 'utf8',
            'DBCollat' => 'utf8_general_ci',
        ];

        foreach ($daftar_kecamatan as $kec) {
            // Tunjuk ke database CI3 masing-masing Kapanewon
            $db_config['database'] = 'db_' . $kec;

            try {
                // Koneksi ke database
                $db_kec = \Config\Database::connect($db_config, false);

                $nama_format = 'Kecamatan ' . ucfirst($kec);
                $url_format  = 'http://' . $kec . '.gunungkidulkab.go.id/';

                if ($tanggal_dari && $tanggal_ke) {
                    $sql = "SELECT COUNT(judul) AS jumlah, ? AS nm, ? AS url, SUM(dibaca) AS total_baca 
                            FROM tbl_artikel 
                            WHERE create_at BETWEEN ? AND ?";
                    $binds = [$nama_format, $url_format, $tanggal_dari . ' 00:00:00', $tanggal_ke . ' 23:59:59'];
                } else {
                    $sql = "SELECT COUNT(judul) AS jumlah, ? AS nm, ? AS url, SUM(dibaca) AS total_baca 
                            FROM tbl_artikel";
                    $binds = [$nama_format, $url_format];
                }

                // Ambil 1 baris hasil (karena pakai agregat COUNT dan SUM)
                $result = $db_kec->query($sql, $binds)->getRow();

                // Simpan ke array
                $data_hasil['kec_' . $kec] = $result;

                // WAJIB: Tutup koneksi agar memori server tidak jebol
                $db_kec->close();
            } catch (\Exception $e) {
                // Jika satu web Kapanewon databasenya bermasalah, bypass agar dashboard tidak error
                $data_hasil['kec_' . $kec] = (object)[
                    'jumlah' => 0,
                    'nm' => 'Kecamatan ' . ucfirst($kec),
                    'url' => 'http://' . $kec . '.gunungkidulkab.go.id/',
                    'total_baca' => 0
                ];
            }
        }

        return $data_hasil;
    }
}
