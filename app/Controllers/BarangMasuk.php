<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BarangMasuk extends BaseController
{
    // Function untuk menampilkan halaman riwayat barang masuk
    public function index()
    {
        $title['title'] = "Riwayat Barang Masuk - Admin";
        return view ('admin/barang-masuk/index', ['title' => $title]);
    }
}
