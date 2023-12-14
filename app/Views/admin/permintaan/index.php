<!-- menghubungkan tampilan ini dengan tampilan admin layout -->
<?= $this->extend('admin/layout/admin_layout');?>
<!-- Menginisialisasi bahwa halaman ini adalah content -->
<?= $this->section('content');?>

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
                                            <img src="assets/img/icons/filter.svg" alt="img">
                                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                        </a>
                                    </div>
                                    <div class="search-input">
                                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                                    </div>
                                </div>
                                <div class="wordset">
                                    <ul>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
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
                                            <th>Nama</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $groupedData = [];

                                            // Group data by 'kode_permintaan'
                                            foreach ($data['permintaan'] as $pm) {
                                                $kodePermintaan = $pm['kode_permintaan'];
                                                if (!isset($groupedData[$kodePermintaan])) {
                                                    $groupedData[$kodePermintaan] = $pm;
                                                }
                                            }

                                            // Display the grouped data
                                            foreach ($groupedData as $pm) :
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $pm['tanggal_permintaan'] ?></td>
                                            <td><?= $pm['pemohon'] ?></td>
                                            <td>
                                                <?php
                                                $status = $pm['status'];

                                                switch ($status) {
                                                    case 'Diajukan':
                                                        $badgeClass = 'bg-info';
                                                        break;
                                                    case 'Diproses':
                                                        $badgeClass = 'bg-warning';
                                                        break;
                                                    case 'Disetujui':
                                                        $badgeClass = 'bg-success';
                                                        break;
                                                    case 'Dibatalkan':
                                                        $badgeClass = 'bg-danger';
                                                        break;
                                                    default:
                                                        $badgeClass = 'bg-dark';
                                                        break;
                                                }
                                                ?>

                                                <span class="badges <?= $badgeClass ?>"><?= $status ?></span>
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
<?= $this->endSection();?>