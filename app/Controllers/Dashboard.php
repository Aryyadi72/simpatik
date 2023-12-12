<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    // Function untuk menampilkan halaman dashboard admin
    public function index()
    {
        if (session()->get('id') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('/login'));
        }

        $title['title'] = "Dashboard - Admin";
        return view('admin/admin_dash', ['title' => $title]);
    }

    // Function untuk menampilkan halaman dashboard guru
    public function dashboardGuru()
    {
        if (session()->get('id') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('/login'));
        }

        $title['title'] = "Dashboard - Guru";
        return view('guru/guru_dash', ['title' => $title]);
    }
}
