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

        try {
            $this->penggunaModel->saveUser([
                'username' => $username,
                'password' => $password,
                'level_user' => $level_user,
            ]);
            return redirect()->to('/pengguna')->with('success', 'Pengguna berhasil ditambahkan!');
        } catch (\InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
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

        try {
            $this->penggunaModel->updateUser($id, [
                'username' => $username,
                'password' => $password,
                'level_user' => $level_user,
            ]);
            return redirect()->to('/pengguna')->with('success', 'Data pengguna berhasil diperbarui!');
        } catch (\InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
