<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DashboardModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $model = new DashboardModel();

        return view('tamu/dashboard', [
            'totalTamu'     => $model->totalTamu(),
            'totalHariIni'  => $model->totalHariIni(),
            'rekapLokasi'   => $model->rekapLokasi(),
            'latestTamu'    => $model->latestTamu(10)
        ]);
    }
}
