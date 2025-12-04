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
}
