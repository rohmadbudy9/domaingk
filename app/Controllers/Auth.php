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
        // Ambil input
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Init model & cache service
        $penggunaModel = new PenggunaModel();
        $cache = service('cache');

        // -------------------------
        // RATE LIMITING PER IP
        // -------------------------
        // Gunakan hash agar key aman (tidak mengandung karakter terlarang)
        $ip = $this->request->getIPAddress();
        $ipKey = 'login_ip_' . md5($ip);

        $ipAttempts = (int) ($cache->get($ipKey) ?? 0);

        // Jika IP sudah melebihi batas
        if ($ipAttempts >= 10) {
            return redirect()->back()->with('error', 'Terlalu banyak percobaan login dari IP ini. Tunggu 10 menit.');
        }

        // Tambah hit IP (expired 600 detik = 10 menit)
        $cache->save($ipKey, $ipAttempts + 1, 600);

        // -------------------------
        // CARI USER
        // -------------------------
        $user = $penggunaModel->where('username', $username)->first();

        if (! $user) {
            // Untuk keamanan jangan ungkap apakah username atau password salah secara detail
            return redirect()->back()->with('error', 'Username atau password salah.');
        }

        // Pastikan nilai numerik untuk login_attempts
        $userAttempts = isset($user['login_attempts']) ? intval($user['login_attempts']) : 0;
        $userLastAttempt = $user['last_attempt'] ?? null;

        // -------------------------
        // CEK AKUN TERKUNCI
        // -------------------------
        // Jika sudah mencapai batas dan masih dalam periode lock
        if ($userAttempts >= 5 && $userLastAttempt !== null && strtotime($userLastAttempt) > strtotime('-10 minutes')) {
            $remainingSeconds = (strtotime($userLastAttempt) + 600) - time();
            $minutes = max(1, ceil($remainingSeconds / 60));
            return redirect()->back()->with('error', "Akun dikunci sementara. Coba lagi dalam {$minutes} menit.");
        }

        // -------------------------
        // VALIDASI PASSWORD
        // -------------------------
        if (password_verify($password, $user['password'])) {
            // Berhasil login
            // Reset percobaan pada user (jika ada)
            $updateData = [
                'login_attempts' => 0,
                'last_attempt'   => null
            ];

            if (! empty($updateData) && isset($user['id'])) {
                $penggunaModel->update($user['id'], $updateData);
            }

            // Reset hit IP pada cache
            $cache->delete($ipKey);

            // Regenerate session id untuk keamanan - mencegah session fixation
            session()->regenerate(true);

            // Simpan session user
            session()->set([
                'logged_in' => true,
                'username' => $user['username'],
                'level_user' => $user['level_user']
            ]);

            return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
        }

        // -------------------------
        // PASSWORD SALAH -> TANGANI GAGAL LOGIN
        // -------------------------
        // Increment login_attempts pada user (pastikan tidak menyebabkan update kosong)
        $newAttempts = $userAttempts + 1;
        $updateUser = [
            'login_attempts' => $newAttempts,
            'last_attempt'   => date('Y-m-d H:i:s')
        ];

        // Hanya lakukan update jika user punya id dan updateUser tidak kosong
        if (! empty($updateUser) && isset($user['id'])) {
            $penggunaModel->update($user['id'], $updateUser);
        }

        $remaining = 5 - $newAttempts;
        if ($remaining <= 0) {
            return redirect()->back()->with('error', 'Terlalu banyak percobaan gagal. Akun dikunci selama 10 menit.');
        }

        return redirect()->back()->with('error', "Username atau password salah. Kesempatan tersisa: {$remaining} kali.");
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }
}
