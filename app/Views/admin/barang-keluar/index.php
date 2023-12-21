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
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/1') ?>">Januari</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/2') ?>">Februari</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/3') ?>">Maret</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/4') ?>">April</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/5') ?>">Mei</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/6') ?>">Juni</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/7') ?>">Juli</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/8') ?>">Agustus</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/9') ?>">September</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/10') ?>">Oktober</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/11') ?>">November</a>
                                            <a class="dropdown-item" href="<?= site_url('/pdf-generate-barang-keluar/12') ?>">Desember</a>
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