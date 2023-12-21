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
                    <h4>Riwayat Barang Masuk</h4>
                </div>
                <div class="page-btn">
                    <a href="<?= base_url('masuk-history-add') ?>" class="btn btn-added"><img
                            src="assets/img/icons/plus.svg" alt="img" class="me-1">Tambah Barang Masuk</a>
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
                                <div class="wordset">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cetak</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/1') ?>">Januari</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/2') ?>">Februari</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/3') ?>">Maret</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/4') ?>">April</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/5') ?>">Mei</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/6') ?>">Juni</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/7') ?>">Juli</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/8') ?>">Agustus</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/9') ?>">September</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/10') ?>">Oktober</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/11') ?>">November</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate/12') ?>">Desember</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  datanew ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data['barang'] as $barang): ?>
                                            <tr>
                                                <td>
                                                    <?= $no++ ?>
                                                </td>
                                                <td>
                                                    <?= \Carbon\Carbon::parse($barang['tanggal_masuk'])->format('d-m-Y') ?>
                                                </td>
                                                <td>
                                                    <?= \Carbon\Carbon::parse($barang['tanggal_masuk'])->format('h:i') ?>
                                                </td>
                                                <td>
                                                    <?= $barang['nama_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $barang['jumlah'] ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
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