<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BarangKeluar extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }
    }

    // Function untuk menampilkan halaman riwayat barang keluar
    public function index()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Riwayat Barang Keluar - Admin";
        return view ('admin/barang-keluar/index', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }
}
