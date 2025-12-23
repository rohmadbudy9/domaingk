<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DashboardModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $model = new DashboardModel();

        $data = [
            'username'        => session()->get('username'),
            'level_user'      => session()->get('level_user'),

            // Statistik utama
            'totalTamu'       => $model->totalTamu(),

            // Rekap penting
            'rekapLokasi'     => $model->rekapLokasi(),
            // 'rekapKeperluan'  => $model->rekapKeperluan(),

            // Data operasional
            'latestTamu'      => $model->latestTamu(10),
        ];

        return view('tamu/dashboard', $data);
    }
}
