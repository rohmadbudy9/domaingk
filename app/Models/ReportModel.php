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

    // 🔹 Ambil report dengan join & filter
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

    // 🔹 Simpan massal report
    public function saveReports(array $statuses, array $notes, string $checked_by, string $checked_at)
    {
        foreach ($statuses as $domain_id => $status) {
            // Validasi status sederhana
            if (!in_array($status, ['up', 'down'])) {
                continue; // skip jika status invalid
            }

            $data = [
                'domain_id'  => $domain_id,
                'status'     => $status,
                'note'       => $status === 'down' ? ($notes[$domain_id] ?? null) : null,
                'checked_at' => $checked_at,
                'checked_by' => $checked_by,
            ];

            $this->save($data);
        }
    }
}
