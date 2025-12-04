<?php

namespace App\Controllers;

use App\Models\DataModel;
use App\Models\ReportModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends BaseController
{
    protected $DataModel;
    protected $ReportModel;

    public function __construct()
    {
        $this->DataModel = new DataModel();
        $this->ReportModel = new ReportModel();
    }

    // 🔹 Submit report
    public function submitreport()
    {
        $statuses = $this->request->getPost('status');
        $notes    = $this->request->getPost('note') ?? [];

        $today = date('Y-m-d');
        $user = session()->get('username');

        $this->ReportModel->saveReports($statuses, $notes, $user, $today);

        return redirect()->to('/dashboard/')->with('success', 'Report berhasil disimpan!');
    }

    // 🔹 Tampilkan report
    public function report()
    {
        $date = $this->request->getGet('date') ?? date('Y-m-d');
        $kategori = $this->request->getGet('kategori');

        $kategori_list = $this->DataModel->select('kategori')->distinct()->findAll();
        $checks = $this->ReportModel->getReportData($date, $kategori);

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

    // 🔹 Export PDF
    public function exportPDF()
    {
        $date = $this->request->getGet('date') ?? date('Y-m-d');
        $kategori = $this->request->getGet('kategori');

        $checks = $this->ReportModel->getReportData($date, $kategori);

        $html = view('report/pdf_template', [
            'checks' => $checks,
            'selected_date' => $date,
            'selected_kategori' => $kategori
        ]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream('Report_' . $date . '.pdf', ['Attachment' => 1]);
    }

    // 🔹 Export Excel
    public function exportExcel()
    {
        $date = $this->request->getGet('date') ?? date('Y-m-d');
        $kategori = $this->request->getGet('kategori');

        $checks = $this->ReportModel->getReportData($date, $kategori);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'Nama OPD');
        $sheet->setCellValue('B1', 'Alamat Web');
        $sheet->setCellValue('C1', 'Kategori');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Catatan');
        $sheet->setCellValue('F1', 'Tanggal Cek');
        $sheet->setCellValue('G1', 'Diperiksa Oleh');

        // Data
        $row = 2;
        foreach ($checks as $check) {
            $sheet->setCellValue('A' . $row, $check['nama_opd']);
            $sheet->setCellValue('B' . $row, $check['alamat_web']);
            $sheet->setCellValue('C' . $row, $check['kategori']);
            $sheet->setCellValue('D' . $row, $check['status']);
            $sheet->setCellValue('E' . $row, $check['note']);
            $sheet->setCellValue('F' . $row, $check['checked_at']);
            $sheet->setCellValue('G' . $row, $check['checked_by']);
            $row++;
        }

        // Auto width
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Report_' . $date . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
