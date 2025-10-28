<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'level_user'];

    public function getAdmins()
    {
        return $this->where('level_user', 'admin')->findAll();
    }

    public function getUsers()
    {
        return $this->where('level_user', 'user')->findAll();
    }
}
