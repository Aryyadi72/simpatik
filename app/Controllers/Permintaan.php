<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Carbon\Carbon;

class Permintaan extends BaseController
{
    // Function untuk menampilkan halaman permintaan masuk
    public function index()
    {
        $title['title'] = "Permintaan Masuk - Admin";
        return view('admin/permintaan/index', ['title' => $title]);
    }

    public function permintaanGuru()
    {
        $title['title'] = "Tambah Permintaan - Guru";
        return view('guru/permintaan/index', ['title' => $title]);
    }

    public function listBarang()
    {
        $barangModel = new \App\Models\Barang();
        $data['barang'] = $barangModel->orderBy('id', 'ASC')->findAll();
        $title['title'] = "List Barang - Guru";
        return view('guru/permintaan/barang', ['title' => $title, 'data' => $data]);
    }

    private function generateKodePermintaan()
    {
        $permintaanModel = new \App\Models\PermintaanBarang;
        $latestKodePermintaan = $permintaanModel->getLatestKodePermintaan();
        $kodePermintaanNumber = intval(substr($latestKodePermintaan, 2)) + 1;
        $kodePermintaan = 'KP' . str_pad($kodePermintaanNumber, 2, '0', STR_PAD_LEFT);

        return $kodePermintaan;
    }

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
                    'kode_barang'           => $kodeBarang,
                    'jumlah'                => $jumlahBarang[$index],
                    'kode_permintaan'       => $kodePermintaan,
                    'tanggal_permintaan'    => Carbon::now(),
                    'pemohon'               => 'guru',
                    'status'                => 'Diajukan',
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
}
