<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }
    }

    // Function untuk menampilkan halaman users
    public function index()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $usersModel = new \App\Models\Users();
        $data['users'] = $usersModel->orderBy('id', 'ASC')->findAll();
        // Judul untuk halaman
        $title['title'] = "Users - Admin";
        // mengarahkan tampilan ke halaman users yang berada di dalam folder users dan folder index
        return view('admin/users/index', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk menampilkan halaman tambah data users
    public function add()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Tambah Users - Admin";
        return view('admin/users/insert', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
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
            session()->setFlashdata("error", "NIK sudah digunakan.");
            return redirect()->back();
        }

        if ($userModel->isExists(['email' => $email])) {
            session()->setFlashdata("error", "Email sudah digunakan.");
            return redirect()->back();
        }

        if ($userModel->isExists(['no_hp' => $phone])) {
            session()->setFlashdata("error", "Nomor HP sudah digunakan.");
            return redirect()->back();
        }

        if ($userModel->isExists(['username' => $username])) {
            session()->setFlashdata("error", "Username sudah digunakan.");
            return redirect()->back();
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
        session()->setFlashdata("success", "Berhasil disimpan!");
        return redirect()->to(site_url('/users'));
    }

    public function updateForm($id)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $userModel = new \App\Models\Users();
        $data['users'] = $userModel->find($id);
        $title['title'] = "Ubah User - Admin";

        return view('admin/users/update', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
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

        session()->setFlashdata("success", "Berhasil disimpan!");
        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $userModel = new \App\Models\Users();
        $userData = $userModel->find($id);

        if (empty($userData)) {
            session()->setFlashdata("error", "User tidak ditemukan.");
            return redirect()->to('/users');
        }

        $userModel->delete($id);

        session()->setFlashdata("success", "Berhasil disimpan!");
        return redirect()->to('/users');
    }
}
