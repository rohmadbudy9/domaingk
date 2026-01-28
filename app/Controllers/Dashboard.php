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

    public function totalBerita()
    {
        // helper('wp');

        $opd = [
            [
                'nama' => 'Dishub',
                'url'  => 'https://dishub.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'BPBD',
                'url'  => 'https://bpbd.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'DKP',
                'url'  => 'https://dkp.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Inspektorat',
                'url'  => 'https://inspektorat.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Kebudayaan',
                'url'  => 'https://kebudayaan.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Kesbangpol',
                'url'  => 'https://kesbangpol.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Perindustrian',
                'url'  => 'https://perindustrian.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Perdagangan',
                'url'  => 'https://perdagangan.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Lingkungan Hidup',
                'url'  => 'https://lh.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Pemberdayaan Masyarakat',
                'url'  => 'https://pemberdayaan.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Pertanian',
                'url'  => 'https://pertanian.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'PUPRKP',
                'url'  => 'https://puprkp.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Satpol PP',
                'url'  => 'https://satpolpp.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Setda',
                'url'  => 'https://setda.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Sosial',
                'url'  => 'https://sosial.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Tata Ruang',
                'url'  => 'https://tataruang.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Setwan',
                'url'  => 'https://setwan.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Peternakan',
                'url'  => 'https://peternakan.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Dinkes',
                'url'  => 'https://dinkes.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Dukcapil',
                'url'  => 'https://dukcapil.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'BKAD',
                'url'  => 'https://bkad.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Bappeda',
                'url'  => 'https://bappeda.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'Wisata',
                'url'  => 'https://wisata.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],
            [
                'nama' => 'DPK',
                'url'  => 'https://dpk.gunungkidulkab.go.id/wp-json/wp/v2/posts?per_page=1'
            ],

        ];

        $hasil = [];

        foreach ($opd as $o) {
            $hasil[] = [
                'nama'  => $o['nama'],
                'total' => wp_total_posts($o['url'])
            ];
        }

        // contoh output JSON (untuk dashboard / chart)
        // return $this->response->setJSON($hasil);
        return $this->response
        ->setStatusCode(200)
        ->setContentType('application/json')
        ->setJSON($hasil);

    }
}
