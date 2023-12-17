<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BarangMasuk extends BaseController
{
    // Function untuk menampilkan halaman riwayat barang masuk
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        if (!$this->session->has('id')) {
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');

        $barangMasukModel = new \App\Models\BarangMasuk();
        $data['barang'] = $barangMasukModel->getAllBarang();

        $title['title'] = "Riwayat Barang Masuk - Admin";
        return view('admin/barang-masuk/index', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function menampilkan halaman tambah barang masuk
    public function add()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');
        $barangModel = new \App\Models\Barang();
        $data['barang'] = $barangModel->orderBy('id', 'ASC')->findAll();
        $title['title'] = "Tambah Barang Masuk - Admin";
        return view('admin/barang-masuk/insert', ['title' => $title, 'data' => $data, 'userId' => $userId, 'nama' => $nama, 'level' => $level]);
    }

    // Function untuk menangani proses tambah barang masuk kedalam database
    public function store()
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $barangModel = new \App\Models\Barang();

        $kodeBarang = $this->request->getPost('kode_barang');
        $jumlahMasuk = $this->request->getPost('jumlah');
        $tanggalMasuk = $this->request->getVar('tanggal_masuk');

        $barangMasukModel->insert([
            'kode_barang' => $kodeBarang,
            'jumlah' => $jumlahMasuk,
            'tanggal_masuk' => $tanggalMasuk,
        ]);

        $barang = $barangModel->where('kode_barang', $kodeBarang)->first();
        $stokSaatIni = $barang['stok_barang'];

        $stokBaru = $stokSaatIni + $jumlahMasuk;

        $barangModel->update($barang['id'], ['stok_barang' => $stokBaru]);

        // Mengarahkan tampilan ke halaman users dengan menggunakan routing users
        return redirect()->to(site_url('/barang'))->with('success', 'Data berhasil ditambahkan');
    }

    public function exportExcel()
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $data['barang'] = $barangMasukModel->getAllBarang();

        // Inisialisasi objek Spreadsheet dari PhpSpreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Barang')
            ->setCellValue('C1', 'Jumlah');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($data['barang'] as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal_masuk'])
                ->setCellValue('B' . $column, $data['nama_barang'])
                ->setCellValue('C' . $column, $data['jumlah']);
            $column++;
        }

        // tulis dalam format .xlsx
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'export_barang_masuk_' . date('YmdHis') . '.xlsx';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
