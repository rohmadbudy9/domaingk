<?php

namespace App\Models;

use CodeIgniter\Model;

class TamuModel extends Model
{
    protected $table      = 'tb_tamu';
    protected $primaryKey = 'id';
    protected $allowedFields = [
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
}
