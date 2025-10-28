<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================
// 🔐 AUTHENTICATION
// ==========================
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/doLogin', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

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
// 🌐 PING FUNCTION
// ==========================
$routes->get('/ping-page', 'DataController::pingList');
$routes->get('/data/editping/(:num)', 'DataController::editping/$1');
$routes->post('/data/updateping/(:num)', 'DataController::updateping/$1');
$routes->get('/data/ping/(:num)', 'DataController::ping/$1');


// ==========================
// 🧾 REPORT
// ==========================
$routes->get('/report', 'ReportController::report');
$routes->post('/report/submitreport', 'ReportController::submitreport');

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
