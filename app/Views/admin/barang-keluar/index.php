<!-- menghubungkan tampilan ini dengan tampilan admin layout -->
<?= $this->extend('admin/layout/admin_layout'); ?>
<!-- Menginisialisasi bahwa halaman ini adalah content -->
<?= $this->section('content'); ?>

<div class="main-wrapper">
    <div class="page-wrapper pagehead">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Riwayat Barang Keluar</h4>
                    <h6>Tabel riwayat barang keluar</h6>
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
                                    <ul>
                                        <li>
                                            <a href="<?= site_url('exportBarangKeluar') ?>" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Export to Excel">
                                                <img src="assets/img/icons/excel.svg" alt="Excel">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  datanew ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Pemohon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data['barang'] as $bk):
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $no++ ?>
                                                </td>
                                                <td>
                                                    <?= $bk['tanggal_keluar'] ?>
                                                </td>
                                                <td>
                                                    <?= $bk['nama_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $bk['jumlah'] ?>
                                                </td>
                                                <td>
                                                    <?= $bk['nama'] ?>
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