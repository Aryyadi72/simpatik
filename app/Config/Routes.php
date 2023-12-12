<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::index');
$routes->post('/auth-processLogin', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');

// Routing menuju dashboard admin
$routes->get('/dash-admin', 'Dashboard::index');

// Routing menuju dashboard guru
$routes->get('/dash-guru', 'Dashboard::dashboardGuru');

// Routing menuju halaman permintaan masuk
$routes->get('/permintaan-masuk', 'Permintaan::index');

$routes->get('/barang', 'Barang::index');
$routes->get('/barang-add', 'Barang::add');
$routes->post('/barang-store', 'Barang::store');
$routes->get('/barang-ubah/(:num)', 'Barang::updateForm/$1');
$routes->post('/barang-update', 'Barang::update');
$routes->get('barang/delete/(:num)', 'Barang::delete/$1', ['as' => 'delete_barang']);

// Routing untuk menuju halaman users
$routes->get('/users', 'Users::index');

// Routing untuk menuju halaman tambah users
$routes->get('/users-add', 'Users::add');

// Routing untuk menambahkan data ke database
$routes->post('/users-store', 'Users::store');

// Routing untuk menuju halaman riwayat barang masuk
$routes->get('/masuk-history', 'BarangMasuk::index');
$routes->get('/masuk-history-add', 'BarangMasuk::add');
$routes->post('/masuk-history-store', 'BarangMasuk::store');

// Routing untuk menuju halaman riwayat barang keluar
$routes->get('/keluar-history', 'BarangKeluar::index');


// Routing Guru
// Routing menuju dashboard guru
$routes->get('/dash-guru', 'Dashboard::dashboardGuru');

// Routing menuju halaman tambah permintaan
$routes->get('/permintaan-guru', 'Permintaan::permintaanGuru');
$routes->post('/permintaan-store', 'Permintaan::store');

$routes->get('/list-barang', 'Permintaan::listBarang');
