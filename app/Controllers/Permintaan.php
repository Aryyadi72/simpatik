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
        $nama   = $this->session->get('nama');
        $level  = $this->session->get('level');

        $permintaanModel = new \App\Models\PermintaanBarang();
        $data['permintaan'] = $permintaanModel
            ->select('permintaan_barang.*, barang.*, users.*, permintaan_barang.id as pbid')
            ->join('barang', 'barang.kode_barang = permintaan_barang.kode_barang')
            ->join('users', 'permintaan_barang.pemohon = users.id', 'left')
            ->orderBy('permintaan_barang.id', 'ASC')
            ->findAll();

        $title['title'] = "Permintaan Masuk - Admin";
        return view('admin/permintaan/index', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk menampilkan halaman tambah permintaan untuk guru
    public function permintaanGuru()
    {
        $userId = $this->session->get('id'); 
        if (!$userId) {
            return redirect()->to(base_url('login'));
        }

        $permintaanModel = new \App\Models\PermintaanBarang();

        $data['permintaan'] = $permintaanModel
            ->select('permintaan_barang.*, barang.*')
            ->join('barang', 'barang.kode_barang = permintaan_barang.kode_barang')
            ->where('permintaan_barang.pemohon', $userId)
            ->findAll();

        $userId = $this->session->get('id');
        $nama   = $this->session->get('nama');
        $level  = $this->session->get('level');

        $title['title'] = "Tambah Permintaan - Guru";
        return view('guru/permintaan/index', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level, 'data' => $data]);
    }

    // Function untuk menampilkan halaman list barang yang akan dipilih guru
    public function listBarang()
    {
        $userId = $this->session->get('id');
        $nama   = $this->session->get('nama');
        $level  = $this->session->get('level');
        $barangModel = new \App\Models\Barang();
        $data['barang'] = $barangModel->orderBy('id', 'ASC')->findAll();
        $title['title'] = "List Barang - Guru";
        return view('guru/permintaan/barang', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk membuat kode random kode permintaan
    private function generateKodePermintaan()
    {
        $permintaanModel        = new \App\Models\PermintaanBarang;
        $latestKodePermintaan   = $permintaanModel->getLatestKodePermintaan();
        $kodePermintaanNumber   = intval(substr($latestKodePermintaan, 2)) + 1;
        $kodePermintaan         = 'KP' . str_pad($kodePermintaanNumber, 2, '0', STR_PAD_LEFT);

        return $kodePermintaan;
    }

    // Function untuk menambahkan data permintaan yang dikirimkan dari view ke database
    public function store()
    {
        $permintaanModel = new \App\Models\PermintaanBarang;

        $kodePermintaan = $this->generateKodePermintaan();

        $jumlahBarang       = $this->request->getVar('jumlah');
        $pemohonBarang      = $this->request->getVar('pemohon');
        $barangTerpilih     = $this->request->getVar('barang_terpilih');

        // Validasi jumlah barang dan barang terpilih
        if (!empty($jumlahBarang) && !empty($barangTerpilih)) {
            // Iterate through selected items
            foreach ($barangTerpilih as $index => $kodeBarang) {
                $data = [
                    'kode_barang'           => $kodeBarang,
                    'jumlah'                => $jumlahBarang[$index],
                    'kode_permintaan'       => $kodePermintaan,
                    'tanggal_permintaan'    => Carbon::now(),
                    'pemohon'               => $pemohonBarang,
                    'status'                => 'diajukan',
                    'keterangan'            => 'Menunggu Persetujuan Admin',
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
        $nama   = $this->session->get('nama');
        $level  = $this->session->get('level');

        $permintaanModel = new \App\Models\PermintaanBarang();

        $data['permintaan'] = $permintaanModel
            ->where('kode_permintaan', $kode_permintaan)
            ->join('barang', 'barang.kode_barang = permintaan_barang.kode_barang')
            ->get()
            ->getResultArray();

        $title['title'] = "Permintaan Detail - Admin";
        return view('admin/permintaan/detail', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    public function updateForm($id)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');

        $permintaanModel = new \App\Models\PermintaanBarang();
        $data['permintaan'] = $permintaanModel->find($id);

        $title['title'] = "Proses Permintaan - Admin";

        return view('admin/permintaan/detail', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    public function editProses($id)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Proses Permintaan - Admin";

        $permintaanModel = new \App\Models\PermintaanBarang();

        // Mendapatkan data permintaan barang yang akan di-edit
        $data['permintaan'] = $permintaanModel->find($id);

        if ($this->request->getMethod() === 'post') {
            // Mengambil data yang di-submit dari form edit
            $newStatus = $this->request->getVar('status');
            $newKeterangan = $this->request->getVar('keterangan');

            // Update data status dan keterangan
            $updatedData = [
                'status' => $newStatus,
                'keterangan' => $newKeterangan
            ];

            // Melakukan validasi jika data berhasil di-update
            if ($permintaanModel->update($id, $updatedData)) {
                return redirect()->to(site_url('/permintaan-masuk'))->with('success', 'Data berhasil di-update');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
            }
        }

        // Tampilkan form untuk mengedit status dan keterangan
        return view('admin/permintaan/proses', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    public function editSelesai($id)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Proses Permintaan - Admin";

        $permintaanModel = new \App\Models\PermintaanBarang();

        // Mendapatkan data permintaan barang yang akan di-edit
        $data['permintaan'] = $permintaanModel->find($id);

        if ($this->request->getMethod() === 'post') {
            // Mengambil data yang di-submit dari form edit
            $newStatus = $this->request->getVar('status');
            $newKeterangan = $this->request->getVar('keterangan');

            // Update data status dan keterangan
            $updatedData = [
                'status' => $newStatus,
                'keterangan' => $newKeterangan
            ];

            // Melakukan validasi jika data berhasil di-update
            if ($permintaanModel->update($id, $updatedData)) {
                return redirect()->to(site_url('/permintaan-masuk'))->with('success', 'Data berhasil di-update');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
            }
        }

        // Tampilkan form untuk mengedit status dan keterangan
        return view('admin/permintaan/selesai', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    public function editSelesaiA($id)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Proses Permintaan - Admin";

        $permintaanModel = new \App\Models\PermintaanBarang();

        // Mendapatkan data permintaan barang yang akan di-edit
        $data['permintaan'] = $permintaanModel->find($id);

        if ($this->request->getMethod() === 'post') {
            // ... (kode yang sudah ada sebelumnya)
            $newStatus = $this->request->getVar('status');
            $newKeterangan = $this->request->getVar('keterangan');

            // Logika tambahan setelah proses update status dan keterangan
            if ($newStatus === 'disetujui') {
                $barangModel = new \App\Models\Barang();
                $barangKeluarModel = new \App\Models\BarangKeluar();

                // Mendapatkan jumlah barang yang diminta
                $jumlahDiminta = $data['permintaan']['jumlah'];

                // Mendapatkan data barang dari tabel barang
                $dataBarang = $barangModel->find($data['permintaan']['kode_barang']);

                // Mengurangi stok barang
                $stokBaru = $dataBarang['stok'] - $jumlahDiminta;

                // Update stok barang di tabel barang
                $updatedStokBarang = [
                    'stok' => $stokBaru
                ];

                // Lakukan update stok barang
                $barangModel->update($data['permintaan']['kode_barang'], $updatedStokBarang);

                // Insert data ke tabel barang_keluar
                $dataBarangKeluar = [
                    'kode_barang' => $data['permintaan']['kode_barang'],
                    'jumlah_keluar' => $jumlahDiminta,
                    'tanggal_keluar' => date('Y-m-d H:i:s') // Tanggal saat ini
                    // Jika ada kolom lain, sesuaikan di sini
                ];

                $barangKeluarModel->insert($dataBarangKeluar);
            }

            return view('admin/permintaan/selesai', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
        }
    }


    public function editBatal($id)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Proses Permintaan - Admin";

        $permintaanModel = new \App\Models\PermintaanBarang();

        // Mendapatkan data permintaan barang yang akan di-edit
        $data['permintaan'] = $permintaanModel->find($id);

        if ($this->request->getMethod() === 'post') {
            // Mengambil data yang di-submit dari form edit
            $newStatus = $this->request->getVar('status');
            $newKeterangan = $this->request->getVar('keterangan');

            // Update data status dan keterangan
            $updatedData = [
                'status' => $newStatus,
                'keterangan' => $newKeterangan
            ];

            // Melakukan validasi jika data berhasil di-update
            if ($permintaanModel->update($id, $updatedData)) {
                return redirect()->to(site_url('/permintaan-masuk'))->with('success', 'Data berhasil di-update');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
            }
        }

        // Tampilkan form untuk mengedit status dan keterangan
        return view('admin/permintaan/batal', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

}
