<!-- menghubungkan tampilan ini dengan tampilan admin layout -->
<?= $this->extend('admin/layout/admin_layout'); ?>
<!-- Menginisialisasi bahwa halaman ini adalah content -->
<?= $this->section('content'); ?>

<div class="main-wrapper">
    <div class="page-wrapper pagehead">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Permintaan Masuk</h4>
                    <h6>Tabel list permintaan masuk</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-path">
                                        <a class="btn btn-filter" id="filter_search">
                                            <img src="<?= base_url() ?>assets/img/icons/filter.svg" alt="img">
                                            <span><img src="<?= base_url() ?>assets/img/icons/closes.svg"
                                                    alt="img"></span>
                                        </a>
                                    </div>
                                    <div class="search-input">
                                        <a class="btn btn-searchset"><img
                                                src="<?= base_url() ?>assets/img/icons/search-white.svg" alt="img"></a>
                                    </div>
                                </div>
                                <div class="wordset">
                                    <ul>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                                    src="<?= base_url() ?>assets/img/icons/pdf.svg" alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                                    src="<?= base_url() ?>assets/img/icons/excel.svg" alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                                    src="<?= base_url() ?>assets/img/icons/printer.svg" alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  datanew ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Permintaan</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data['permintaan'] as $permintaan):
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $no++ ?>
                                                </td>
                                                <td>
                                                    <?= $permintaan['kode_permintaan'] ?>
                                                </td>
                                                <td>
                                                    <?= $permintaan['nama_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $permintaan['jumlah'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $status = $permintaan['status'];

                                                    switch ($status) {
                                                        case 'diajukan':
                                                            $badgeClass = 'bg-info';
                                                            break;
                                                        case 'diproses':
                                                            $badgeClass = 'bg-warning';
                                                            break;
                                                        case 'selesai':
                                                            $badgeClass = 'bg-success';
                                                            break;
                                                        case 'dibatalkan':
                                                            $badgeClass = 'bg-danger';
                                                            break;
                                                        default:
                                                            $badgeClass = 'bg-dark';
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="badges <?= $badgeClass ?>">
                                                        <?= $status ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($status === 'diajukan'): ?>
                                                        <a class="btn btn-warning"
                                                            href="<?= base_url('update-status-permintaan/' . $permintaan['id'] . '/diproses') ?>">
                                                            <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                        <a class="btn btn-danger"
                                                            href="<?= base_url('update-status-permintaan/' . $permintaan['id'] . '/dibatalkan') ?>">
                                                            <i class="fa fa-ban"></i>
                                                        </a>
                                                    <?php elseif ($status === 'diproses'): ?>
                                                        <a class="btn btn-success"
                                                            href="<?= base_url('update-status-permintaan/' . $permintaan['id'] . '/selesai') ?>">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                        <a class="btn btn-danger"
                                                            href="<?= base_url('update-status-permintaan/' . $permintaan['id'] . '/dibatalkan') ?>">
                                                            <i class="fa fa-ban"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <button class="btn btn-secondary btn-sm">Permintaan Selesai</button>
                                                    <?php endif; ?>
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