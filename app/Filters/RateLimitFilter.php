<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services;

class RateLimitFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $ip = $request->getIPAddress();
        $cache = cache();

        // 💡 Gunakan hash agar tidak ada karakter terlarang seperti ":" pada IPv6
        $safeKey = 'login_attempt_' . md5($ip);
        $attempts = $cache->get($safeKey) ?? 0;

        if ($attempts >= 10) {
            // HTTP 429 = Too Many Requests
            return Services::response()
                ->setStatusCode(429)
                ->setBody('Terlalu banyak percobaan login dari IP ini. Tunggu 5 menit.');
        }

        // Simpan percobaan login, expired dalam 5 menit (300 detik)
        $cache->save($safeKey, $attempts + 1, 300);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi lanjutan
    }
}
