<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    // Function untuk menampilkan halaman dashboard admin
    public function index()
    {
        $title['title'] = "Dashboard - Admin";
        return view('admin/admin_dash', ['title' => $title]);
    }

    public function dashboardGuru()
    {
        $title['title'] = "Dashboard - Guru";
        return view('guru/guru_dash', ['title' => $title]);
    }
}
