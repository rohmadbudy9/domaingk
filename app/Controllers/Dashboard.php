<?php

namespace App\Controllers;

use App\Models\DataModel;
use App\Models\PenggunaModel;

class Dashboard extends BaseController
{
    protected $DataModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->DataModel = new DataModel();
        $this->penggunaModel = new PenggunaModel();
    }

    public function index()
    {
        $data = [
            'username' => session()->get('username'),
            'level_user' => session()->get('level_user'),
            'count_opd' => $this->DataModel->where('kategori', 'OPD')->countAllResults(),
            'count_kapanewon' => $this->DataModel->where('kategori', 'kapanewon')->countAllResults(),
            'count_puskesmas' => $this->DataModel->where('kategori', 'puskesmas')->countAllResults(),
            'count_puskeswan' => $this->DataModel->where('kategori', 'puskeswan')->countAllResults(),
            'count_bpp' => $this->DataModel->where('kategori', 'bpp')->countAllResults(),
            'count_ikm' => $this->DataModel->where('kategori', 'ikm')->countAllResults(),
            'count_other' => $this->DataModel->where('kategori', 'other')->countAllResults(),
            'count_cekslot' => $this->DataModel->where('kategori', 'cekslot')->countAllResults(),
            'count_ping' => $this->DataModel->where('kategori', 'ping')->countAllResults()
        ];
        return view('data/dashboard', $data);
    }

    public function kategori($kategori)
    {
        $data = [
            'websites' => $this->DataModel->where('kategori', $kategori)->findAll(),
            'kategori' => ucfirst($kategori),
            'username' => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];

        return view('data/isi_data', $data);
    }
}
