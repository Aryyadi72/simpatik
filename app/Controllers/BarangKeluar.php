<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class BarangKeluar extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }
    }

    // Function untuk menampilkan halaman riwayat barang keluar
    public function index()
    {
        $userId = $this->session->get('id');
        $nama = $this->session->get('nama');
        $level = $this->session->get('level');

        $barangKeluarModel = new \App\Models\BarangKeluar();
        $data['barang'] = $barangKeluarModel->getBarangKeluar();

        $title['title'] = "Riwayat Barang Keluar - Admin";
        return view('admin/barang-keluar/index', ['title' => $title, 'userId' => $userId, 'nama' => $nama, 'level' => $level, 'data' => $data]);
    }

    public function exportBarangKeluar()
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        $data['barang'] = $barangKeluarModel->getBarangKeluar();

        // Inisialisasi objek Spreadsheet dari PhpSpreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Barang')
            ->setCellValue('C1', 'Jumlah')
            ->setCellValue('D1', 'Pemohon');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($data['barang'] as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal_keluar'])
                ->setCellValue('B' . $column, $data['nama_barang'])
                ->setCellValue('C' . $column, $data['jumlah'])
                ->setCellValue('D' . $column, $data['nama']);
            $column++;
        }

        // tulis dalam format .xlsx
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'export_barang_keluar_' . date('YmdHis') . '.xlsx';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function generate($month = null)
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        $data = [];

        if ($month !== null) {
            $data['barang'] = $barangKeluarModel->getBarangKeluarByMonth($month);
        } else {
            $data['barang'] = $barangKeluarModel->getBarangKeluar();
        }
        
        $filename = date('y-m-d-H-i-s'). '-laporan-barang-keluar';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('admin/barang-keluar/pdf_view', ['data' => $data]));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}
