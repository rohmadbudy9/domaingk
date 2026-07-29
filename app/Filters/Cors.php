<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Biarkan kosong, karena Preflight OPTIONS sudah kita tangani di Routes.php
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Paksa CI4 untuk selalu menempelkan header ini sebelum data dikirim ke browser
        $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setHeader('Access-Control-Allow-Headers', '*');
        $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
    }
}