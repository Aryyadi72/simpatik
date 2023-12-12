<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        $title['title'] = "Login - SIMPATIK";
        return view ('login_page', ['title' => $title]);
    }

    public function processLogin() 
    {
        $usersModel = new \App\Models\Users();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $usersModel->where('username', $username)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            session()->set('username', $user['username']);
            session()->set('nama', $user['nama']);
            session()->set('id', $user['id']);
    
            if ($user['level'] == 'admin') {
                return redirect()->to(base_url('/dash-admin'));
            } else {
                return redirect()->to(base_url('/dash-guru'));
            }
        } else {
            session()->setFlashdata('gagal', 'Username / Password salah');
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout()
    {
        $session = \Config\Services::session();
        
        $session->destroy();

        return redirect()->to('/login')->with('success', 'Logout berhasil.');
    }
}
