<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = 'tb_domain';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_opd', 'alamat_web', 'kategori'];
}
