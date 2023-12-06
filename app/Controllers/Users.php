<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    // Function untuk menampilkan halaman users
    public function index()
    {
        // Judul untuk halaman
        $title['title'] = "Users - Admin";
        // mengarahkan tampilan ke halaman users yang berada di dalam folder users dan folder index
        return view ('admin/users/index', ['title' => $title]);
    }

    // Function untuk menampilkan halaman tambah data users
    public function add()
    {
        $title['title'] = "Tambah Users - Admin";
        return view ('admin/users/insert', ['title' => $title]);
    }

    // Function untuk menambahkan data users kedalam database
    public function store()
    {
        // Memanggil model Users
        $usersModel = new \App\Models\Users();

        // Mengambil data dari form yang ada di view dan memasukkannya kedalam variabel $data
        $data = [
            'nik'       => $this->request->getVar('nik'),
            'nama'      => $this->request->getVar('nama'),
            'no_hp'     => $this->request->getVar('no_hp'),
            'email'     => $this->request->getVar('email'),
            'username'  => $this->request->getVar('username'),
            'password'  => $this->request->getVar('password'),
            'level'     => $this->request->getVar('level'),
        ];

        // Menambahkan data yang ada di dalam $data kedalam database
        $usersModel->insert($data);

        // Mengarahkan tampilan ke halaman users dengan menggunakan routing users
        return redirect()->to(site_url('/users'));
    }
}
