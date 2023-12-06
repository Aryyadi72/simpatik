<!-- menghubungkan tampilan ini dengan tampilan admin layout -->
<?= $this->extend('admin/layout/admin_layout');?>
<!-- Menginisialisasi bahwa halaman ini adalah content -->
<?= $this->section('content');?>

<div class="main-wrapper">
    <div class="page-wrapper pagehead">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Barang</h4>
                    <h6>Tabel list barang</h6>
                </div>
                <div class="page-btn">
                    <a href="<?= base_url('barang-masuk') ?>" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Tambah</a>
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
                                        <?php $no=1 ?>
                                        <!-- memanggil data dari controller Barang function index dan menampilkan datanya menggunakan perulangan -->
                                        <?php foreach($data['barang'] as $barang): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $barang['kode_barang'] ?></td>
                                            <td><?= $barang['nama_barang'] ?></td>
                                            <td><?= $barang['jenis_barang'] ?></td>
                                            <td><?= $barang['stok_barang'] ?></td>
                                            <td>
                                                <!-- Menampilkan gambar yang sudah di upload kedalam database -->
                                                <?php if (!empty($barang['foto_barang'])) : ?>
                                                    <img src="<?= base_url($barang['foto_barang']) ?>" alt="Foto Barang" width="50">
                                                <?php else : ?>
                                                    <span>No Image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit" data-bs-toggle="tooltip" title="Ubah Data"></i></a>
                                                <a href="" class="btn btn-danger"><i class="fa fa-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></a>
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
<?= $this->endSection();?>