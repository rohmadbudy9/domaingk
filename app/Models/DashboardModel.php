<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'tb_tamu';

    public function totalTamu(): int
    {
        return $this->countAllResults();
    }

    public function totalHariIni(): int
    {
        return $this->where('DATE(created_at)', date('Y-m-d'))
            ->countAllResults();
    }

    public function rekapLokasi(): array
    {
        return $this->select('lokasi_dc, COUNT(*) as total')
            ->groupBy('lokasi_dc')
            ->findAll();
    }

    public function latestTamu(int $limit = 10): array
    {
        return $this->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}
