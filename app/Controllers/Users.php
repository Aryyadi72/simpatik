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
        $userModel = new \App\Models\Users();

        // Ambil data dari form
        $nik        = $this->request->getPost('nik');
        $nama       = $this->request->getPost('nama');
        $phone      = $this->request->getPost('no_hp');
        $email      = $this->request->getPost('email');
        $username   = $this->request->getPost('username');
        $password   = $this->request->getPost('password');
        $level      = $this->request->getPost('level');

        // Cek apakah NIK, Email, Phone, dan Username sudah ada
        if ($userModel->isExists(['nik' => $nik])) {
            return redirect()->back()->withInput()->with('error', 'NIK sudah digunakan.');
        }

        if ($userModel->isExists(['email' => $email])) {
            return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
        }

        if ($userModel->isExists(['no_hp' => $phone])) {
            return redirect()->back()->withInput()->with('error', 'Nomor HP sudah digunakan.');
        }

        if ($userModel->isExists(['username' => $username])) {
            return redirect()->back()->withInput()->with('error', 'Username sudah digunakan.');
        }

        // Hash password sebelum menyimpan ke database
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Data yang akan disimpan ke dalam database
        $data = [
            'nik' => $nik,
            'nama' => $nama,
            'no_hp' => $phone,
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword,
            'level' => $level,
            // ... tambahkan data lainnya sesuai kebutuhan
        ];

        // Simpan data ke dalam database
        $userModel->insert($data);

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->to(site_url('/users'))->with('success', 'Data user berhasil ditambahkan.');
    }
}
