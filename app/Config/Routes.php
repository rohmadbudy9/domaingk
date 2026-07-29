<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================
// TAMU
// ==========================
$routes->get('/tamu', 'TamuController::addtamu');
$routes->post('/tamu/review', 'TamuController::review');
$routes->post('/tamu/submitFinal', 'TamuController::submitFinal');
$routes->get('/tamu/success', 'TamuController::success');
$routes->get('/tamu/exportPDF/(:num)', 'TamuController::exportPDF/$1');
$routes->get('/dashboardtamu', 'DashboardController::index');
// ==========================
// 🔐 AUTHENTICATION
// ==========================
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->post('/doLogin', 'Auth::doLogin', ['filter' => 'ratelimit']);


// ==========================
// 🏠 DASHBOARD
// ==========================
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/kategori/(:segment)', 'Dashboard::kategori/$1');
// ==========================
// 📦 DATA CRUD
// ==========================
$routes->get('/data/add', 'DataController::add');
$routes->post('/data/insert', 'DataController::insert');
$routes->get('/data/edit/(:num)', 'DataController::edit/$1');
$routes->post('/data/update/(:num)', 'DataController::update/$1');
$routes->get('/data/delete/(:num)', 'DataController::delete/$1');

// ==========================
// 🧾 REPORT
// ==========================
$routes->get('/report', 'ReportController::report');
$routes->post('/report/submitreport', 'ReportController::submitreport');
$routes->get('/report/exportPDF', 'ReportController::exportPDF');
$routes->get('/report/exportExcel', 'ReportController::exportExcel');

// ==========================
// 👑 ADMIN ONLY
// ==========================
$routes->group('pengguna', ['AuthFilter' => 'Admin'], function ($routes) {
    $routes->get('/', 'PenggunaController::index');
    $routes->get('register', 'PenggunaController::register');
    $routes->post('insert', 'PenggunaController::insert');
    $routes->get('edit/(:num)', 'PenggunaController::edit/$1');
    $routes->post('update/(:num)', 'PenggunaController::update/$1');
    $routes->get('delete/(:num)', 'PenggunaController::delete/$1');
});

$routes->get('/opd/totalberita', 'Dashboard::totalBerita');
// ==========================
// API ROUTES
// ==========================

// 1. Tambahkan baris ini untuk menangani Preflight CORS (OPTIONS Request)
$routes->options('api/(:any)', function () {
    $response = response();
    $response->setStatusCode(204);
    $response->setHeader('Access-Control-Allow-Origin', '*');
    $response->setHeader('Access-Control-Allow-Headers', '*');
    $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
    return $response;
});

// 2. Ini adalah rute Anda yang sudah ada sebelumnya
$routes->get('api/daftar_berita/(:segment)', 'Api::daftar_berita/$1');
$routes->get('api/artikel/(:segment)', 'Api::artikel/$1');
