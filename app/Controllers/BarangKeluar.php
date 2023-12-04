<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BarangKeluar extends BaseController
{
    public function index()
    {
        $title['title'] = "Riwayat Barang Keluar - Admin";
        return view ('admin/barang-keluar/index', $title);
    }
}
