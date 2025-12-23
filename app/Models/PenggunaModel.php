<<<<<<< HEAD
<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'password',
        'level_user',
        'login_attempts',
        'last_attempt'
    ];

    // Ambil semua admin
    public function getAdmins()
    {
        return $this->where('level_user', 'admin')->findAll();
    }

    // Ambil semua user
    public function getUsers()
    {
        return $this->where('level_user', 'user')->findAll();
    }

    // 🔹 Simpan pengguna baru dengan validasi password otomatis
    public function saveUser(array $data)
    {
        if (isset($data['password'])) {
            $this->validatePassword($data['password']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->save($data);
    }

    // 🔹 Update pengguna, termasuk password jika diisi
    public function updateUser($id, array $data)
    {
        if (!empty($data['password'])) {
            $this->validatePassword($data['password']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            // Jika password kosong, jangan ikutkan dalam update
            unset($data['password']);
        }

        return $this->update($id, $data);
    }

    // 🔒 Fungsi internal untuk validasi password
    private function validatePassword($password)
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            throw new \InvalidArgumentException(
                'Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.'
            );
        }
    }
}
=======
<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'password',
        'level_user',
        'login_attempts',
        'last_attempt'
    ];

    // Ambil semua admin
    public function getAdmins()
    {
        return $this->where('level_user', 'admin')->findAll();
    }

    // Ambil semua user
    public function getUsers()
    {
        return $this->where('level_user', 'user')->findAll();
    }

    // 🔹 Simpan pengguna baru dengan validasi password otomatis
    public function saveUser(array $data)
    {
        if (isset($data['password'])) {
            $this->validatePassword($data['password']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->save($data);
    }

    // 🔹 Update pengguna, termasuk password jika diisi
    public function updateUser($id, array $data)
    {
        if (!empty($data['password'])) {
            $this->validatePassword($data['password']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            // Jika password kosong, jangan ikutkan dalam update
            unset($data['password']);
        }

        return $this->update($id, $data);
    }

    // 🔒 Fungsi internal untuk validasi password
    private function validatePassword($password)
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            throw new \InvalidArgumentException(
                'Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.'
            );
        }
    }
}
>>>>>>> b872c1704fed7a636a406e651b4e762dd0fe1006
