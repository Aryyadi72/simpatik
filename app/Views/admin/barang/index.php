<!-- menghubungkan tampilan ini dengan tampilan admin layout -->
<?= $this->extend('admin/layout/admin_layout'); ?>
<!-- Menginisialisasi bahwa halaman ini adalah content -->
<?= $this->section('content'); ?>

<!-- Alert untuk menampilkan pesan suksess atau error -->
<?php
$success = session()->getFlashdata('success');
$error = session()->getFlashdata('error');

if (!empty($success)) {
    echo "<script>alert('" . $success . "');</script>";
}

if (!empty($error)) {
    echo "<script>alert('" . $error . "');</script>";
}
?>

<div class="main-wrapper">
    <div class="page-wrapper pagehead">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Barang</h4>
                    <h6>Tabel list barang</h6>
                </div>
                <div class="page-btn">
                    <a href="<?= base_url('barang-add') ?>" class="btn btn-added"><img src="assets/img/icons/plus.svg"
                            alt="img" class="me-1">Tambah</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-input">
                                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  datanew ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Barang</th>
                                            <th>Jenis</th>
                                            <th>Stok</th>
                                            <th>Foto</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- inisialisasi variabel nomor -->
                                        <?php $no = 1 ?>
                                        <!-- memanggil data dari controller Barang function index dan menampilkan datanya menggunakan perulangan -->
                                        <?php foreach ($data['barang'] as $barang): ?>
                                            <tr>
                                                <td>
                                                    <?= $no++ ?>
                                                </td>
                                                <td>
                                                    <?= $barang['kode_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $barang['nama_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $barang['jenis_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $barang['stok_barang'] ?>
                                                </td>
                                                <td>
                                                    <!-- Menampilkan gambar yang sudah di upload kedalam database -->
                                                    <?php if (!empty($barang['foto_barang'])): ?>
                                                        <img src="<?= base_url($barang['foto_barang']) ?>" alt="Foto Barang"
                                                            width="50">
                                                    <?php else: ?>
                                                        <span>No Image</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('barang-ubah/' . $barang['id']) ?>"
                                                        class="btn btn-warning"><i class="fa fa-edit"
                                                            data-bs-toggle="tooltip" title="Ubah Data"></i></a>
                                                    <a href="<?= route_to('delete_barang', $barang['id']); ?>"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                            class="fa fa-trash" data-bs-toggle="tooltip"
                                                            title="Hapus"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Mengakhiri perulangan -->
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mengakhiri inisialisasi content pada halaman ini -->
<?= $this->endSection(); ?>