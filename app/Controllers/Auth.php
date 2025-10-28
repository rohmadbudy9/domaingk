<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function doLogin()
    {
        $session = session();
        $model = new PenggunaModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'level_user' => $user['level_user'],
                    'logged_in' => true
                ]);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/login')->with('error', 'Password salah!');
            }
        } else {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login')->with('success', 'Berhasil logout.');
    }
}
