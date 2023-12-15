<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Barang extends BaseController
{
    protected $filters = ['auth'];
    // Helper bawaan ci4 untuk membuat form
    protected $helpers = ['form'];

    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }
    }

    // Function untuk menampilkan data barang dari database di halaman barang
    public function index()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $barangModel = new \App\Models\Barang();
        $data['barang'] = $barangModel->orderBy('id', 'ASC')->findAll();
        $title['title'] = "Barang - Admin";
        return view('admin/barang/index', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk menampilkan halaman tambah barang
    public function add()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $title['title'] = "Tambah Barang - Admin";
        return view('admin/barang/insert', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk membuat kode barang secara random
    private function generateKodeBarang()
    {
        $barangModel = new \App\Models\Barang();
        $latestKodeBarang = $barangModel->getLatestKodeBarang();
        $kodeBarangNumber = intval(substr($latestKodeBarang, 3)) + 1;
        $kodeBarang = 'ATK' . str_pad($kodeBarangNumber, 2, '0', STR_PAD_LEFT);

        return $kodeBarang;
    }

    // Function untuk menambahkan data barang yang dikirimkan dari view ke database
    public function store()
    {
        // Meload model barang
        $barangModel = new \App\Models\Barang();

        if ($this->request->getMethod() !== 'post') {
            return redirect('index');
        }

        // Meload function generatekodebarang diatas
        $kodeBarang = $this->generateKodeBarang();

        // Melakukan validasi input gambar
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

        // Jika validasi benar maka masukan data kedalam database
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

    // Function untuk menampilkan halaman update barang
    public function updateForm($id)
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $barangModel = new \App\Models\Barang();
        $data['barang'] = $barangModel->find($id);
        $title['title'] = "Ubah Barang - Admin";

        return view('admin/barang/update', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk memproses update data barang
    public function update()
    {
        $barangModel = new \App\Models\Barang();

        $id = $this->request->getPost('id');
        $namaBarang = $this->request->getPost('nama_barang');
        $jenisBarang = $this->request->getPost('jenis_barang');

        $image = $this->request->getFile('foto_barang');

        if ($image->isValid() && !$image->hasMoved()) {
            $filename = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $filename);

            $updatedData = [
                'nama_barang' => $namaBarang,
                'jenis_barang' => $jenisBarang,
                'foto_barang' => 'uploads/' . $filename,
            ];
        } else {
            $updatedData = [
                'nama_barang' => $namaBarang,
                'jenis_barang' => $jenisBarang,
            ];
        }

        $barangModel->update($id, $updatedData);

        return redirect()->to(base_url('barang'))->with('success', 'Data updated successfully');
    }

    // Function untuk menghapus data barang
    public function delete($id)
    {
        $barangModel = new \App\Models\Barang();
        $barang = $barangModel->find($id);

        if ($barang) {
            $namaFile = $barang['foto_barang'];

            $pathToFile = ROOTPATH . 'public/' . $namaFile;
            if (file_exists($pathToFile)) {
                unlink($pathToFile);
            }

            // dd($pathToFile);

            $barangModel->delete($id);

            return redirect()->to(base_url('barang'))->with('success', 'Data berhasil dihapus');
        }

    }

}
