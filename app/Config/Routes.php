<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::index');

// Routing menuju dashboard admin
$routes->get('/dash-admin', 'Dashboard::index');

// Routing menuju halaman permintaan masuk
$routes->get('/permintaan-masuk', 'Permintaan::index');

// Routing menuju halaman tampil barang
$routes->get('/barang', 'Barang::index');

// Routing menuju halaman tambah barang
$routes->get('/barang-masuk', 'Barang::add');

// Routing untuk menambahkan data ke database
$routes->post('/barang-store', 'Barang::store');

// Routing untuk menuju halaman users
$routes->get('/users', 'Users::index');

// Routing untuk menuju halaman tambah users
$routes->get('/users-add', 'Users::add');

// Routing untuk menambahkan data ke database
$routes->post('/users-store', 'Users::store');

// Routing untuk menuju halaman riwayat barang masuk
$routes->get('/masuk-history', 'BarangMasuk::index');

// Routing untuk menuju halaman riwayat barang keluar
$routes->get('/keluar-history', 'BarangKeluar::index');
