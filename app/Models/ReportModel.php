<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table      = 'tb_report';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'domain_id',
        'status',
        'note',
        'checked_at',
        'checked_by',
        'created_at'
    ];

    protected $useTimestamps = false;

    // 🔹 Fungsi custom untuk ambil report dengan join & filter
    public function getReportData($date = null, $kategori = null)
    {
        $builder = $this->select('tb_report.*, tb_domain.nama_opd, tb_domain.alamat_web, tb_domain.kategori')
                        ->join('tb_domain', 'tb_domain.id = tb_report.domain_id');

        if ($date) {
            $builder->where('tb_report.checked_at', $date);
        }

        if ($kategori) {
            $builder->where('tb_domain.kategori', $kategori);
        }

        return $builder->orderBy('tb_domain.nama_opd', 'ASC')->findAll();
    }
    
}
