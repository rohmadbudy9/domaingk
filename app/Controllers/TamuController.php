<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TamuModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class TamuController extends BaseController
{
    public function addtamu()
    {
        return view('tamu/regiss', [
            'title' => 'Form Registrasi Tamu'
        ]);
    }

    public function insert()
    {
        // Ambil file upload
        $fotoDiri = $this->request->getFile('foto_diri');
        $fotoKTP  = $this->request->getFile('foto_ktp');

        // Beri nama random jika valid
        $fotoDiriName = $fotoDiri->isValid() ? $fotoDiri->getRandomName() : null;
        $fotoKTPName  = $fotoKTP->isValid() ? $fotoKTP->getRandomName() : null;

        // Pindahkan file (jika valid)
        if ($fotoDiri->isValid()) {
            $fotoDiri->move('uploads/foto_diri/', $fotoDiriName);
        }

        if ($fotoKTP->isValid()) {
            $fotoKTP->move('uploads/foto_ktp/', $fotoKTPName);
        }

        // Insert ke tabel tamu
        $model = new TamuModel();

        $tamuID = $model->insert([
            'lokasi_dc'          => $this->request->getPost('lokasi_dc'),
            'kategori_keperluan' => $this->request->getPost('kategori_keperluan'),
            'keperluan'          => $this->request->getPost('keperluan'),
            'nama'               => $this->request->getPost('nama'),
            'asal'               => $this->request->getPost('asal'),
            'nomor_hp'           => $this->request->getPost('nomor_hp'),
            'email'              => $this->request->getPost('email'),
            'jumlah'             => $this->request->getPost('jumlah'),
            'aktivitas'          => $this->request->getPost('aktivitas'),
            'tanggal_kedatangan' => $this->request->getPost('tanggal_kedatangan'),
            'waktu_kedatangan'   => $this->request->getPost('waktu_kedatangan'),
            'foto_diri'          => $fotoDiriName,
            'foto_ktp'           => $fotoKTPName,
        ]);

        // Insert personel tambahan
        $personel_nama = $this->request->getPost('personel_nama');
        $personel_hp   = $this->request->getPost('personel_hp');

        if (!empty($personel_nama)) {
            $db = \Config\Database::connect();
            foreach ($personel_nama as $key => $nama) {
                if (!empty(trim($nama))) {
                    $db->table('tamu_personel')->insert([
                        'tamu_id'  => $tamuID,
                        'nama'     => $nama,
                        'nomor_hp' => $personel_hp[$key]
                    ]);
                }
            }
        }

        // Arahkan ke export PDF
        return redirect()->to(base_url('tamu/exportPDF/' . $tamuID));
    }

    public function exportPDF($id)
    {
        $model = new TamuModel();
        $tamu  = $model->find($id);

        if (!$tamu) {
            return redirect()->back()->with('error', 'Data tamu tidak ditemukan');
        }

        $db = \Config\Database::connect();
        $personel = $db->table('tamu_personel')
            ->where('tamu_id', $id)
            ->get()
            ->getResult();

        $html = view('tamu/pdf_template', [
            'tamu'     => $tamu,
            'personel' => $personel,
            'tamu_id'  => $id
        ]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'Tamu_' . date('Ymd_His') . '.pdf';

        return $dompdf->stream($filename, ["Attachment" => 1]);
    }
    public function review()
    {
        $form = $this->request->getPost();

        if ($form['keperluan'] === 'Other') {
            $form['keperluan'] = $this->request->getPost('keperluan_other');
        }

        $rules = [
            'foto_diri' => 'uploaded[foto_diri]|max_size[foto_diri,2048]|is_image[foto_diri]|mime_in[foto_diri,image/jpg,image/jpeg,image/png]',
            'foto_ktp'  => 'uploaded[foto_ktp]|max_size[foto_ktp,2048]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->getErrors());
        }

        $fotoDiri = $this->request->getFile('foto_diri');
        $fotoKtp  = $this->request->getFile('foto_ktp');

        if (! $fotoDiri->isValid() || ! $fotoKtp->isValid()) {
            return redirect()->back()
                ->with('error', 'File upload tidak valid');
        }

        $tmpPath = WRITEPATH . 'uploads/tmp/';
        if (!is_dir($tmpPath)) {
            mkdir($tmpPath, 0777, true);
        }

        $fotoDiriName = $fotoDiri->getRandomName();
        $fotoKtpName  = $fotoKtp->getRandomName();

        $fotoDiri->move($tmpPath, $fotoDiriName);
        $fotoKtp->move($tmpPath, $fotoKtpName);

        // Personel tambahan
        $personel = [];
        if (!empty($form['personel_nama'])) {
            foreach ($form['personel_nama'] as $i => $nama) {
                if (!empty(trim($nama))) {
                    $personel[] = [
                        'nama' => $nama,
                        'nomor_hp' => $form['personel_hp'][$i] ?? null
                    ];
                }
            }
        }

        session()->set('review_data', [
            'form'      => $form,
            'personel'  => $personel,
            'foto_diri' => 'uploads/tmp/' . $fotoDiriName,
            'foto_ktp'  => 'uploads/tmp/' . $fotoKtpName
        ]);

        return view('tamu/review', [
            'form'      => $form,
            'personel'  => $personel,
            'foto_diri' => 'uploads/tmp/' . $fotoDiriName,
            'foto_ktp'  => 'uploads/tmp/' . $fotoKtpName
        ]);
    }
    public function submitFinal()
    {
        $sessionData = session()->get('review_data');

        if (!$sessionData) {
            return redirect()->to('/tamu')->with('error', 'Session habis, silakan isi ulang form');
        }

        $form     = $sessionData['form'];
        $personel = $sessionData['personel'];

        // ===== Generate Nomor Tiket =====
        $model = new \App\Models\TamuModel();
        $tanggal = $form['tanggal_kedatangan']; // yyyy-mm-dd
        $urut = $model->countByTanggal($tanggal) + 1;

        $nomorTiket = 'GK-' .
            date('Ymd', strtotime($tanggal)) . '-' .
            str_pad($urut, 3, '0', STR_PAD_LEFT);

        // ===== Path =====
        $tmpPath = WRITEPATH . 'uploads/tmp/';
        $fotoDiriFinalPath = 'uploads/foto_diri/';
        $fotoKtpFinalPath  = 'uploads/foto_ktp/';

        if (!is_dir(FCPATH . $fotoDiriFinalPath)) {
            mkdir(FCPATH . $fotoDiriFinalPath, 0777, true);
        }

        if (!is_dir(FCPATH . $fotoKtpFinalPath)) {
            mkdir(FCPATH . $fotoKtpFinalPath, 0777, true);
        }

        // ===== Pindahkan File =====
        $fotoDiriName = basename($sessionData['foto_diri']);
        $fotoKtpName  = basename($sessionData['foto_ktp']);

        rename($tmpPath . $fotoDiriName, FCPATH . $fotoDiriFinalPath . $fotoDiriName);
        rename($tmpPath . $fotoKtpName,  FCPATH . $fotoKtpFinalPath . $fotoKtpName);

        // ===== Insert tb_tamu =====
        $tamuId = $model->insert([
            'nomor_tiket'        => $nomorTiket,
            'lokasi_dc'          => $form['lokasi_dc'],
            'kategori_keperluan' => $form['kategori_keperluan'],
            'keperluan'          => $form['keperluan'],
            'nama'               => $form['nama'],
            'asal'               => $form['asal'],
            'nomor_hp'           => $form['nomor_hp'],
            'email'              => $form['email'],
            'jumlah'             => $form['jumlah'],
            'aktivitas'          => $form['aktivitas'],
            'tanggal_kedatangan' => $form['tanggal_kedatangan'],
            'waktu_kedatangan'   => $form['waktu_kedatangan'],
            'foto_diri'          => $fotoDiriName,
            'foto_ktp'           => $fotoKtpName,
        ]);

        // ===== Insert Personel =====
        if (!empty($personel)) {
            $db = \Config\Database::connect();
            foreach ($personel as $p) {
                $db->table('tamu_personel')->insert([
                    'tamu_id'  => $tamuId,
                    'nama'     => $p['nama'],
                    'nomor_hp' => $p['nomor_hp'],
                ]);
            }
        }

        // ===== Bersihkan Session =====
        session()->remove('review_data');

        return redirect()->to('/tamu/success')
            ->with('success', 'Registrasi berhasil')
            ->with('nomor_tiket', $nomorTiket)
            ->with('tamu_id', $tamuId);
    }
    public function success()
    {
        return view('tamu/success', [
            'tamu_id' => session()->get('tamu_id'),
            'nomor_tiket' => session()->get('nomor_tiket')
        ]);
    }
}
