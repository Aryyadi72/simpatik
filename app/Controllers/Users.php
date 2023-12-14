<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    // Function untuk menampilkan halaman users
    public function index()
    {
        $usersModel = new \App\Models\Users();
        $data['users'] = $usersModel->orderBy('id', 'ASC')->findAll();
        // Judul untuk halaman
        $title['title'] = "Users - Admin";
        // mengarahkan tampilan ke halaman users yang berada di dalam folder users dan folder index
        return view ('admin/users/index', ['title' => $title, 'data' => $data]);
    }

    // Function untuk menampilkan halaman tambah data users
    public function add()
    {
        $title['title'] = "Tambah Users - Admin";
        return view('admin/users/insert', ['title' => $title]);
    }

    // Function untuk menambahkan data users kedalam database
    public function store()
    {
        $userModel = new \App\Models\Users();

        // Ambil data dari form
        $nik = $this->request->getPost('nik');
        $nama = $this->request->getPost('nama');
        $phone = $this->request->getPost('no_hp');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $level = $this->request->getPost('level');

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

    public function updateForm($id)
    {
        $userModel = new \App\Models\Users();
        $data['users'] = $userModel->find($id);
        $title['title'] = "Ubah User - Admin";

        return view('admin/users/update', ['title' => $title, 'data' => $data]);
    }

    public function update()
    {
        $userModel = new \App\Models\Users();

        // Ambil data dari form
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $no_hp = $this->request->getPost('no_hp');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi data
        $rules = [
            'email' => 'is_unique[users.email,id,' . $id . ']',
            'no_hp' => 'is_unique[users.no_hp,id,' . $id . ']',
            'username' => 'is_unique[users.username,id,' . $id . ']',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Data yang akan diupdate
        $data = [
            'nama' => $nama,
            'email' => $email,
            'no_hp' => $no_hp,
            'username' => $username,
            'password' => $hashedPassword,
        ];

        // Update data ke dalam database
        $userModel->update($id, $data);

        return redirect()->to('/users')->with('success', 'Data user berhasil diupdate.');
    }

    public function delete($id)
    {
        $userModel = new \App\Models\Users();
        $userData = $userModel->find($id);

        if (empty($userData)) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan.');
        }

        $userModel->delete($id);

        return redirect()->to('/users')->with('success', 'Data user berhasil dihapus.');
    }
}
