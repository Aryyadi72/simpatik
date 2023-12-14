<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $filters = ['auth'];
    // Function untuk menampilkan halaman dashboard admin
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Dashboard - Admin";
        return view('admin/admin_dash', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk menampilkan halaman dashboard guru
    public function dashboardGuru()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Dashboard - Admin";
        $title['title'] = "Dashboard - Guru";
        return view('guru/guru_dash', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }
}
