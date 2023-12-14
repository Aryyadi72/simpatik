<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Carbon\Carbon;

class Permintaan extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }
    }

    // Function untuk menampilkan halaman permintaan masuk
    public function index()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $permintaanModel = new \App\Models\PermintaanBarang();
        $data['permintaan'] = $permintaanModel->orderBy('id', 'ASC')->findAll();
        $title['title'] = "Permintaan Masuk - Admin";
        return view('admin/permintaan/index', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk menampilkan halaman tambah permintaan untuk guru
    public function permintaanGuru()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Tambah Permintaan - Guru";
        return view('guru/permintaan/index', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk menampilkan halaman list barang yang akan dipilih guru
    public function listBarang()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $barangModel = new \App\Models\Barang();
        $data['barang'] = $barangModel->orderBy('id', 'ASC')->findAll();
        $title['title'] = "List Barang - Guru";
        return view('guru/permintaan/barang', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk membuat kode random kode permintaan
    private function generateKodePermintaan()
    {
        $permintaanModel = new \App\Models\PermintaanBarang;
        $latestKodePermintaan = $permintaanModel->getLatestKodePermintaan();
        $kodePermintaanNumber = intval(substr($latestKodePermintaan, 2)) + 1;
        $kodePermintaan = 'KP' . str_pad($kodePermintaanNumber, 2, '0', STR_PAD_LEFT);

        return $kodePermintaan;
    }

    // Function untuk menambahkan data permintaan yang dikirimkan dari view ke database
    public function store()
    {
        $permintaanModel = new \App\Models\PermintaanBarang;

        $kodePermintaan = $this->generateKodePermintaan();

        $jumlahBarang = $this->request->getVar('jumlah');
        $barangTerpilih = $this->request->getVar('barang_terpilih');

        // Validasi jumlah barang dan barang terpilih
        if (!empty($jumlahBarang) && !empty($barangTerpilih)) {
            // Iterate through selected items
            foreach ($barangTerpilih as $index => $kodeBarang) {
                $data = [
                    'kode_barang' => $kodeBarang,
                    'jumlah' => $jumlahBarang[$index],
                    'kode_permintaan' => $kodePermintaan,
                    'tanggal_permintaan' => Carbon::now(),
                    'pemohon' => 'guru',
                    'status' => 'Diajukan',
                    'keterangan' => 'Menunggu Persetujuan Admin',
                ];

                $permintaanModel->insert($data);
            }

            return redirect()->to(site_url('/permintaan-guru'));
        } else {
            // Handle error, redirect back or display a message
            return redirect()->back()->withInput()->with('error', 'Error: Jumlah barang atau barang terpilih tidak valid');
        }
    }

    public function detail($kode_permintaan)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');

        $permintaanModel = new \App\Models\PermintaanBarang();

        $data['permintaan'] = $permintaanModel
            ->where('kode_permintaan', $kode_permintaan)
            ->join('barang', 'barang.kode_barang = permintaan_barang.kode_barang')
            ->get()
            ->getResultArray();

        $title['title'] = "Permintaan Detail - Admin";
        return view('admin/permintaan/detail', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    public function updateStatusPermintaan($id, $new_status)
    {
        // Memastikan status yang diterima valid sesuai kebutuhan aplikasi Anda
        $valid_statuses = ['diajukan', 'diproses', 'selesai', 'dibatalkan'];
        if (!in_array($new_status, $valid_statuses)) {
            // Jika status tidak valid, mungkin hendak ditangani di sini
            return redirect()->to(base_url('halaman-error'));
        }
        // Lakukan pembaruan status di tabel PermintaanBarang berdasarkan $id
        $permintaanModel = new \App\Models\PermintaanBarang();
        $permintaanModel->where('id', $id)->set(['status' => $new_status])->update();
        // Setelah update, arahkan pengguna kembali ke halaman yang sesuai
        return redirect()->to(base_url('/'));
    }
}
