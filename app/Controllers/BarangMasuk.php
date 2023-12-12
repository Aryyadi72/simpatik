<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BarangMasuk extends BaseController
{
    // Function untuk menampilkan halaman riwayat barang masuk
    public function index()
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $data['barang'] = $barangMasukModel->getAllBarang();

        $title['title'] = "Riwayat Barang Masuk - Admin";
        return view ('admin/barang-masuk/index', ['title' => $title, 'data' => $data]);
    }

    public function add()
    {
        $barangModel = new \App\Models\Barang();
        $data['barang'] = $barangModel->orderBy('id', 'ASC')->findAll();
        $title['title'] = "Tambah Barang Masuk - Admin";
        return view ('admin/barang-masuk/insert', ['title' => $title, 'data' => $data]);
    }

    public function store()
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $barangModel = new \App\Models\Barang();

        $kodeBarang = $this->request->getPost('kode_barang');
        $jumlahMasuk = $this->request->getPost('jumlah');
        $tanggalMasuk = $this->request->getVar('tanggal_masuk');
        $inputer = $this->request->getPost('inputer');

        $barangMasukModel->insert([
            'kode_barang'   => $kodeBarang,
            'jumlah'        => $jumlahMasuk,
            'tanggal_masuk' => $tanggalMasuk,
            'inputer'       => $inputer,
        ]);

        $barang = $barangModel->where('kode_barang', $kodeBarang)->first();
        $stokSaatIni = $barang['stok_barang'];

        $stokBaru = $stokSaatIni + $jumlahMasuk;

        $barangModel->update($barang['id'], ['stok_barang' => $stokBaru]);

        // Mengarahkan tampilan ke halaman users dengan menggunakan routing users
        return redirect()->to(site_url('/barang'));
    }
}
