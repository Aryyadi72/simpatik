<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Barang extends BaseController
{
    // Helper bawaan ci4 untuk membuat form
    protected $helpers = ['form'];
    // Function untuk menampilkan data barang dari database di halaman barang
    public function index()
    {
        $barangModel = new \App\Models\Barang();
        $data['barang'] = $barangModel->orderBy('id', 'ASC')->findAll();
        $title['title'] = "Barang - Admin";
        return view('admin/barang/index', ['title' => $title, 'data' => $data]);
    }

    // Function untuk menampilkan halaman tambah barang
    public function add()
    {
        $title['title'] = "Tambah Barang - Admin";
        return view('admin/barang/insert', ['title' => $title]);
    }

    private function generateKodeBarang()
    {
        $barangModel = new \App\Models\Barang();
        $latestKodeBarang = $barangModel->getLatestKodeBarang();
        $kodeBarangNumber = intval(substr($latestKodeBarang, 3)) + 1;
        $kodeBarang = 'ATK' . str_pad($kodeBarangNumber, 2, '0', STR_PAD_LEFT);

        return $kodeBarang;
    }

    // // Function untuk menambahkan data barang yang dikirimkan dari view ke database
    public function store()
    {
        $barangModel = new \App\Models\Barang();

        if ($this->request->getMethod() !== 'post') {
            return redirect('index');
        }

        $kodeBarang = $this->generateKodeBarang();

        $validationRule = [
            'foto_barang' => [
                'label' => 'Image File',
                'rules' => 'uploaded[foto_barang]'
                    . '|is_image[foto_barang]'
                    . '|mime_in[foto_barang,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[foto_barang,1000]'
                    . '|max_dims[foto_barang,4000,4000]',
            ],
        ];
        $validated = $this->validate($validationRule);

        if ($validated) {
            $namaBarang = $this->request->getPost('nama_barang');
            $jenisBarang = $this->request->getPost('jenis_barang');
            $image = $this->request->getFile('foto_barang');
            $filename = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $filename);

            $uploadedImage = [
                'kode_barang' => $kodeBarang,
                'nama_barang' => $namaBarang,
                'jenis_barang' => $jenisBarang,
                'stok_barang' => 0,
                'foto_barang' => 'uploads/' . $filename,
            ];

            $barangModel->insert($uploadedImage);

            if ($barangModel) {
                return redirect()->to(base_url('barang'))
                    ->with('success', 'Image uploaded');
            } else {
                return redirect()->back();
            }

        }
        return redirect()->back();

    }

}
