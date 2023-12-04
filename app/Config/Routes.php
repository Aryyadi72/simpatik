<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Dashboard
$routes->get('/dash-admin', 'Dashboard::index');

// Permintaan
$routes->get('/permintaan-masuk', 'Permintaan::index');

// Barang
$routes->get('/barang', 'Barang::index');
$routes->get('/barang-masuk', 'Barang::add');

// Users
$routes->get('/users', 'Users::index');

// Riwayat Barang Masuk
$routes->get('/masuk-history', 'BarangMasuk::index');

// Riwayat Barang Keluar
$routes->get('/keluar-history', 'BarangKeluar::index');
