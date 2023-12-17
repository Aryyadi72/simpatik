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

        // Inisialisasi model Barang, Users, dan Permintaan Masuk
        $barangModel = new \App\Models\Barang();
        $userModel = new \App\Models\Users;
        $permintaanModel = new \App\Models\PermintaanBarang();

        // Mengambil jumlah barang yang stoknya lebih dari 0
        $jumlahBarangTersedia = $barangModel->where('stok_barang >', 0)->countAllResults();

        // Mengambil jumlah pengguna yang memiliki level 'guru'
        $jumlahGuru = $userModel->where('level', 'guru')->countAllResults();

        // Mengambil jumlah permintaan masuk pada bulan ini
        $bulanTahunIni = date('F Y');
        $bulanIni = date('Y-m');
        $jumlahPermintaanBulanIni = $permintaanModel->like('tanggal_permintaan', $bulanIni)->countAllResults();

        $data = $permintaanModel
            ->select('permintaan_barang.*, barang.nama_barang, users.nama')
            ->join('barang', 'barang.kode_barang = permintaan_barang.kode_barang')
            ->join('users', 'users.id = permintaan_barang.pemohon')
            ->orderBy('permintaan_barang.jumlah', 'DESC')
            ->limit(5)
            ->findAll();

        $title['title'] = "Dashboard - Admin";
        return view('admin/admin_dash', [
            'title' => $title,
            'userId' => $userId,
            'nama' => $nama,
            'level' => $level,
            'barangTersedia' => $jumlahBarangTersedia,
            'jumlahGuru' => $jumlahGuru,
            'bulanTahunIni' => $bulanTahunIni,
            'jumlahPermintaanBulanIni' => $jumlahPermintaanBulanIni,
            'data' => $data
        ]);
    }

    // Function untuk menampilkan halaman dashboard guru
    public function dashboardGuru()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');

        // Inisialisasi model Barang, Users, dan Permintaan Masuk
        $barangModel = new \App\Models\Barang();
        $userModel = new \App\Models\Users;
        $permintaanModel = new \App\Models\PermintaanBarang();

        // Mengambil jumlah barang yang stoknya lebih dari 0
        $jumlahBarangTersedia = $barangModel->where('stok_barang >', 0)->countAllResults();

        // Mengambil jumlah pengguna yang memiliki level 'guru'
        $jumlahGuru = $userModel->where('level', 'guru')->countAllResults();

        // Mengambil jumlah permintaan masuk pada bulan ini
        $bulanTahunIni = date('F Y');
        $bulanIni = date('Y-m');
        $jumlahPermintaanBulanIni = $permintaanModel->like('tanggal_permintaan', $bulanIni)->countAllResults();

        $data = $permintaanModel
            ->select('permintaan_barang.*, barang.nama_barang, users.nama')
            ->join('barang', 'barang.kode_barang = permintaan_barang.kode_barang')
            ->join('users', 'users.id = permintaan_barang.pemohon')
            ->orderBy('permintaan_barang.jumlah', 'DESC')
            ->limit(5)
            ->findAll();

        $title['title'] = "Dashboard - Guru";
        return view('guru/guru_dash', [
            'title' => $title,
            'userId' => $userId,
            'nama' => $nama,
            'level' => $level,
            'barangTersedia' => $jumlahBarangTersedia,
            'jumlahGuru' => $jumlahGuru,
            'bulanTahunIni' => $bulanTahunIni,
            'jumlahPermintaanBulanIni' => $jumlahPermintaanBulanIni,
            'data' => $data
        ]);
    }
}
