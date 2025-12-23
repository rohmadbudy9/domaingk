<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = 'tb_domain';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_opd', 'alamat_web', 'kategori'];

    // 🔹 Buat data baru
    public function createData(array $data)
    {
        return $this->save($data);
    }

    // 🔹 Update data berdasarkan ID
    public function updateData($id, array $data)
    {
        return $this->update($id, $data);
    }

    // 🔹 Hapus data berdasarkan ID
    public function deleteData($id)
    {
        return $this->delete($id);
    }

    // 🔹 Ambil semua data berdasarkan kategori
    public function getByCategory(string $kategori)
    {
        return $this->where('kategori', $kategori)->findAll();
    }

    // 🔹 Ambil data berdasarkan ID
    public function getById($id)
    {
        return $this->find($id);
    }
}
