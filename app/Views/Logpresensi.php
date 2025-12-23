<?php defined('BASEPATH') or exit('No direct script access allowed');

class Logpresensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // Simpan log presensi
    public function simpan()
    {
        $nip     = $this->input->post('nip', true);
        $nama    = $this->input->post('nama', true);
        $tipe    = $this->input->post('tipe', true);
        $latlon  = $this->input->post('latlon', true);
        $jarak   = $this->input->post('jarak', true);
        $devid   = $this->input->post('devid', true);
        $waktu   = $this->input->post('waktu', true) ?? date('Y-m-d H:i:s');
        $ip      = $this->input->ip_address();

        $log = sprintf(
            "[%s] DEV:%s - NIP:%s - Nama: %s - %s - Jarak: %s - Posisi: %s - IP: %s\n",
            $waktu,
            $devid,
            $nip,
            $nama,
            $tipe,
            $jarak,
            $latlon,
            $ip
        );

        $log_file = APPPATH . 'logs/presensi.log';
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);

        echo json_encode(['status' => 'ok']);
    }

    // Lihat isi log
    public function view()
    {
        $log_file = APPPATH . 'logs/presensi.log';

        if (!file_exists($log_file)) {
            show_error('Log file tidak ditemukan.');
        }

        // Ambil input dari form (GET)
        $tanggal_input = $this->input->get('tanggal', true); // dd/mm/yyyy
        $nama          = $this->input->get('nama', true);

        // Normalisasi ke yyyy-mm-dd
        $tanggal = null;
        if ($tanggal_input && preg_match('/^(\d{2})[\/-](\d{2})[\/-](\d{4})$/', $tanggal_input, $m)) {
            $tanggal = $m[3] . '-' . $m[2] . '-' . $m[1]; // yyyy-mm-dd
        }

        $lines = file($log_file);
        $last_lines = array_slice($lines, -1000);

        $filtered = [];

        // Aturan filter:
        if ($nama === 'all') {
            // tampilkan semua data
            $filtered = $last_lines;
        } elseif ($tanggal || $nama) {
            // ada filter tanggal/nama
            $filtered = array_filter($last_lines, function ($line) use ($tanggal, $nama) {
                $match = true;
                if ($tanggal) {
                    $match = $match && (strpos($line, $tanggal) !== false);
                }
                if ($nama) {
                    $match = $match && (stripos($line, "Nama: " . $nama) !== false);
                }
                return $match;
            });
        }
        // kalau tidak ada filter sama sekali -> $filtered tetap kosong

        // Hapus bagian IP
        $clean_lines = array_map(function ($line) {
            return preg_replace('/ - IP: .*/', '', $line);
        }, $filtered);

        // CSS sederhana
        echo '<style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 20px; }
        h2 { margin-bottom: 15px; color: #333; text-align: center;}
        .filter-box {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            text-align: center;
        }
        .filter-box label { margin-right: 12px; font-weight: bold; color: #555; }
        .filter-box input {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-left: 5px;
        }
        .filter-box button {
            padding: 6px 14px;
            background: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .filter-box button:hover { background: #0056b3; }
        .filter-box a { text-decoration: none; color: #333; margin-left: 10px; }
        pre.log-output {
            background: #111;
            color: #0f0;
            padding: 15px;
            border-radius: 8px;
            max-height: 600px;
            overflow: auto;
            font-size: 14px;
            line-height: 1.4em;
        }
    </style>';

        // Form filter
        echo "<h2>Log Presensi</h2>";
        echo '<form method="get" class="filter-box">
        <label>Tanggal (dd/mm/yyyy):
          <input type="text" id="tanggal" name="tanggal" value="' . htmlspecialchars($tanggal_input ?? '') . '" placeholder="dd/mm/yyyy">
        </label>
        <label>Nama:
          <input type="text" name="nama" value="' . htmlspecialchars($nama ?? '') . '" placeholder="Masukkan Nama Anda">
        </label>
        <button type="submit">Filter</button>
        <a href="' . site_url('presensilog') . '">Reset</a>
      </form>';

        // Flatpickr JS
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    flatpickr("#tanggal", {
        dateFormat: "d/m/Y",
        allowInput: true
    });
    </script>';

        // Hasil
        echo "<pre class='log-output'>";
        if (empty($clean_lines)) {
            echo "Tidak ada data.";
        } else {
            echo htmlspecialchars(implode("", $clean_lines));
        }
        echo "</pre>";
    }
}
