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

        $fotoDiri = $this->request->getFile('foto_diri');
        $fotoKtp  = $this->request->getFile('foto_ktp');

        $tmpPath = 'uploads/tmp/';
        if (!is_dir($tmpPath)) {
            mkdir($tmpPath, 0777, true);
        }

        $fotoDiriName = $fotoDiri->getRandomName();
        $fotoKtpName  = $fotoKtp->getRandomName();

        $fotoDiri->move($tmpPath, $fotoDiriName);
        $fotoKtp->move($tmpPath, $fotoKtpName);

        $personel = [];
        if (!empty($form['personel_nama'])) {
            foreach ($form['personel_nama'] as $i => $nama) {
                $personel[] = [
                    'nama' => $nama,
                    'nomor_hp' => $form['personel_hp'][$i]
                ];
            }
        }

        session()->set('review_data', [
            'form' => $form,
            'personel' => $personel,
            'foto_diri' => $tmpPath . $fotoDiriName,
            'foto_ktp' => $tmpPath . $fotoKtpName
        ]);

        return view('tamu/review', [
            'form' => $form,
            'personel' => $personel,
            'foto_diri' => $tmpPath . $fotoDiriName,
            'foto_ktp' => $tmpPath . $fotoKtpName
        ]);
    }
    public function submitFinal()
    {
        $data = session()->get('review_data');
        if (!$data) {
            return redirect()->to('tamu/addtamu');
        }

        $model = new TamuModel();
        $db = \Config\Database::connect();

        // Generate nomor tiket
        $today = date('Ymd');
        $countToday = $model
            ->where('DATE(created_at)', date('Y-m-d'))
            ->countAllResults();

        $nomorTiket = 'TK-' . $today . '-' . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

        // Pindahkan file ke folder final
        $fotoDiriFinal = 'uploads/foto_diri/' . basename($data['foto_diri']);
        $fotoKtpFinal  = 'uploads/foto_ktp/' . basename($data['foto_ktp']);

        rename($data['foto_diri'], $fotoDiriFinal);
        rename($data['foto_ktp'], $fotoKtpFinal);

        // Insert tb_tamu
        $tamuID = $model->insert([
            'nomor_tiket' => $nomorTiket,
            'lokasi_dc' => $data['form']['lokasi_dc'],
            'kategori_keperluan' => $data['form']['kategori_keperluan'],
            'keperluan' => $data['form']['keperluan'],
            'nama' => $data['form']['nama'],
            'asal' => $data['form']['asal'],
            'nomor_hp' => $data['form']['nomor_hp'],
            'email' => $data['form']['email'],
            'jumlah' => $data['form']['jumlah'],
            'aktivitas' => $data['form']['aktivitas'],
            'tanggal_kedatangan' => $data['form']['tanggal_kedatangan'],
            'waktu_kedatangan' => $data['form']['waktu_kedatangan'],
            'foto_diri' => basename($fotoDiriFinal),
            'foto_ktp' => basename($fotoKtpFinal),
        ]);

        // Insert personel
        foreach ($data['personel'] as $p) {
            $db->table('tamu_personel')->insert([
                'tamu_id' => $tamuID,
                'nama' => $p['nama'],
                'nomor_hp' => $p['nomor_hp']
            ]);
        }

        session()->remove('review_data');
        session()->set([
            'tamu_id' => $tamuID,
            'nomor_tiket' => $nomorTiket
        ]);

        return redirect()->to('tamu/success');
    }
    public function success()
    {
        return view('tamu/success', [
            'tamu_id' => session()->get('tamu_id'),
            'nomor_tiket' => session()->get('nomor_tiket')
        ]);
    }
}
