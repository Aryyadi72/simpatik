<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BarangMasuk extends BaseController
{
    public function index()
    {
        $title['title'] = "Riwayat Barang Masuk - Admin";
        return view ('admin/barang-masuk/index', $title);
    }
}
