<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class PenggunaController extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

    // 🔹 Tampilkan semua pengguna
    public function index()
    {
        if (session()->get('level_user') !== 'Admin') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        $data = [
            'users' => $this->penggunaModel->findAll(),
            'username' => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];

        return view('pengguna/isi_pengguna', $data);
    }

    // 🔹 Halaman tambah pengguna
    public function register()
    {
        $data = [
            'username' => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];

        return view('pengguna/register_pengguna', $data);
    }

    // 🔹 Simpan data pengguna baru
    public function insert()
    {
        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));
        $level_user = $this->request->getPost('level_user');

        // 🔒 Validasi password kuat
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
            return redirect()->back()->withInput()->with('error', 'Password harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, serta angka.');
        }

        $this->penggunaModel->save([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level_user' => $level_user,
        ]);

        return redirect()->to('/pengguna')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // 🔹 Hapus pengguna
    public function delete($id)
    {
        $user = $this->penggunaModel->find($id);

        if ($user) {
            $this->penggunaModel->delete($id);
            return redirect()->to('/pengguna')->with('success', 'Pengguna berhasil dihapus!');
        }

        return redirect()->to('/pengguna')->with('error', 'Pengguna tidak ditemukan.');
    }

    // 🔹 Halaman edit pengguna
    public function edit($id)
    {
        $user = $this->penggunaModel->find($id);

        if (!$user) {
            return redirect()->to('/pengguna')->with('error', 'Pengguna tidak ditemukan!');
        }

        $data = [
            'users' => $user,
            'username' => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];

        return view('pengguna/edit_pengguna', $data);
    }

    // 🔹 Update pengguna
    public function update($id)
    {
        $user = $this->penggunaModel->find($id);

        if (!$user) {
            return redirect()->to('/pengguna')->with('error', 'Pengguna tidak ditemukan!');
        }

        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));
        $level_user = $this->request->getPost('level_user');

        $updateData = [
            'username' => $username,
            'level_user' => $level_user
        ];

        // 🔒 Jika password diisi, validasi kekuatannya terlebih dahulu
        if (!empty($password)) {
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
                return redirect()->back()->withInput()->with('error', 'Password harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, serta angka.');
            }

            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->penggunaModel->update($id, $updateData);

        return redirect()->to('/pengguna')->with('success', 'Data pengguna berhasil diperbarui!');
    }
}
