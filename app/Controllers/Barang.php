<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Barang extends BaseController
{
    public function index()
    {
        $title['title'] = "Barang - Admin";
        return view ('admin/barang/index', $title);
    }

    public function add()
    {
        $title['title'] = "Tambah Barang - Admin";
        return view ('admin/barang/insert', $title);
    }
}
