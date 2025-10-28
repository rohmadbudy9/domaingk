<?php

namespace App\Controllers;

use App\Models\DataModel;
use App\Models\ReportModel;

class ReportController extends BaseController
{
    protected $DataModel;

    public function __construct()
    {
        $this->DataModel = new DataModel();
    }

    public function submitreport()
    {
        $reportModel = new ReportModel();

        $statuses = $this->request->getPost('status');
        $notes    = $this->request->getPost('note');

        $today = date('Y-m-d');
        $user = session()->get('username');

        foreach ($statuses as $domain_id => $status) {
            $data = [
                'domain_id'  => $domain_id,
                'status'      => $status,
                'note'        => $status === 'down' ? $notes[$domain_id] : null,
                'checked_at'  => $today,
                'checked_by'  => $user,
            ];

            $reportModel->save($data);
        }

        return redirect()->to('/dashboard/')->with('success', 'Report berhasil disimpan!');
    }

    public function report()
    {
        $reportModel = new ReportModel();
        $DataModel = new DataModel();

        $date = $this->request->getGet('date') ?? date('Y-m-d');
        $kategori = $this->request->getGet('kategori');

        $kategori_list = $DataModel->select('kategori')->distinct()->findAll();

        // Panggil fungsi model
        $checks = $reportModel->getReportData($date, $kategori);

        $data = [
            'username' => session()->get('username'),
            'level_user' => session()->get('level_user'),
            'checks' => $checks,
            'selected_date' => $date,
            'selected_kategori' => $kategori,
            'kategori_list' => $kategori_list
        ];

        return view('/report/report_view', $data);
    }
}
