<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Permintaan extends BaseController
{
    // Function untuk menampilkan halaman permintaan masuk
    public function index()
    {
        $title['title'] = "Permintaan Masuk - Admin";
        return view('admin/permintaan/index', ['title' => $title]);
    }

    public function permintaanGuru()
    {
        $title['title'] = "Tambah Permintaan - Guru";
        return view('guru/permintaan/index', ['title' => $title]);
    }

    public function listBarang()
    {
        $title['title'] = "List Barang - Guru";
        return view('guru/permintaan/barang', ['title' => $title]);
    }
}
