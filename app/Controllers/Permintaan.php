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
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');

        $title['title'] = "Tambah Permintaan - Guru";
        return view('guru/permintaan/index', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level, 'data' => $data]);
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
        $pemohonBarang = $this->request->getVar('pemohon');
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
                    'pemohon' => $pemohonBarang,
                    'status' => 'diajukan',
                    'keterangan' => 'Menunggu Persetujuan Admin',
                ];

                $permintaanModel->insert($data);
            }

            return redirect()->to(site_url('/permintaan-guru'))->with('success', 'Pengajuan berhasil.');
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

    public function updateForm($id)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');

        $permintaanModel = new \App\Models\PermintaanBarang();
        $data['permintaan'] = $permintaanModel->find($id);

        $title['title'] = "Proses Permintaan - Admin";

        return view('admin/permintaan/selesai', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
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

    // public function editSelesai($id)
    // {
    //     $userId = $this->session->get('id');
    //     $nama = $this->session->get('nama');
    //     $level = $this->session->get('level');
    //     $title['title'] = "Proses Permintaan - Admin";

    //     $permintaanModel = new \App\Models\PermintaanBarang();

    //     // Mendapatkan data permintaan barang yang akan di-edit
    //     $data['permintaan'] = $permintaanModel->find($id);

    //     if ($this->request->getMethod() === 'post') {
    //         // Mengambil data yang di-submit dari form edit
    //         $newStatus = $this->request->getVar('status');
    //         $newKeterangan = $this->request->getVar('keterangan');

    //         // Update data status dan keterangan
    //         $updatedData = [
    //             'status' => $newStatus,
    //             'keterangan' => $newKeterangan
    //         ];

    //         // Melakukan validasi jika data berhasil di-update
    //         if ($permintaanModel->update($id, $updatedData)) {
    //             return redirect()->to(site_url('/permintaan-masuk'))->with('success', 'Data berhasil di-update');
    //         } else {
    //             return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
    //         }
    //     }

    //     // Tampilkan form untuk mengedit status dan keterangan
    //     return view('admin/permintaan/selesai', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    // }

    public function updateStatusAndKeterangan($id)
    {
        // Ambil data yang di-submit dari form update
        $newStatus = $this->request->getVar('status');
        $kodeBarang = $this->request->getVar('kode_barang');
        $newKeterangan = $this->request->getVar('keterangan');

        // Jika status sudah diupdate menjadi 'disetujui'
        if ($newStatus === 'disetujui') {
            // Lakukan pembaruan status dan keterangan pada tabel permintaan_barang berdasarkan $id
            $permintaanModel = new \App\Models\PermintaanBarang();
            $updatedData = [
                'status' => $newStatus,
                'keterangan' => $newKeterangan
            ];
            $permintaanModel->update($id, $updatedData);
            // Ambil data permintaan barang yang telah di-update
            $updatedPermintaan = $permintaanModel->find($id);

            // Masukkan data ke tabel barang_keluar
            $barangKeluarModel = new \App\Models\BarangKeluar();
            $dataBarangKeluar = [
                'kode_barang' => $updatedPermintaan['kode_barang'],
                'jumlah' => $updatedPermintaan['jumlah'],
                'tanggal_keluar' => date('Y-m-d H:i:s'), // Tanggal saat ini
                'inputer' => $this->session->get('id'),
                'pemohon' => $updatedPermintaan['pemohon']
            ];
            $barangKeluarModel->insert($dataBarangKeluar);

            // Kurangi stok barang di tabel barang berdasarkan jumlah yang diminta
            $barangModel = new \App\Models\Barang();
            $kodeBarang = $this->request->getVar('kode_barang');
            $dataBarang = $barangModel->where('kode_barang', $kodeBarang)->get()->getRowArray();
            $stokBaru = $dataBarang['stok_barang'] - $updatedPermintaan['jumlah'];
            $updatedStokBarang = [
                'stok_barang' => $stokBaru
            ];
            // Hasil dari dd diatas adalah benar yaitu
            // $updatedStokBarang array (1)
            // ⇄stok_barang => integer 21
            $barangModel->update($kodeBarang, $updatedStokBarang);
            // dd($stokBaru);
        }

        // Redirect pengguna ke halaman yang sesuai setelah proses selesai
        return redirect()->to(base_url('permintaan-masuk'));
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
