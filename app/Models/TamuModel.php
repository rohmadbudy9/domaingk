<?php

namespace App\Models;

use CodeIgniter\Model;

class TamuModel extends Model
{
    protected $table      = 'tb_tamu';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nomor_tiket',
        'lokasi_dc',
        'kategori_keperluan',
        'keperluan',
        'nama',
        'asal',
        'nomor_hp',
        'email',
        'jumlah',
        'aktivitas',
        'tanggal_kedatangan',
        'waktu_kedatangan',
        'foto_diri',
        'foto_ktp'
    ];
    protected $useTimestamps = true;

    public function countByTanggal($tanggal)
    {
        return $this->where('tanggal_kedatangan', $tanggal)->countAllResults();
    }
}
