<!-- menghubungkan tampilan ini dengan tampilan admin layout -->
<?= $this->extend('admin/layout/admin_layout'); ?>
<!-- Menginisialisasi bahwa halaman ini adalah content -->
<?= $this->section('content'); ?>

<div class="main-wrapper">
    <div class="page-wrapper pagehead">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Users</h4>
                    <h6>Tabel list pengguna aplikasi</h6>
                </div>
                <div class="page-btn">
                    <a href="<?= base_url('users-add') ?>" class="btn btn-added"><img src="assets/img/icons/plus.svg"
                            alt="img" class="me-1">Tambah</a>
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
                                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                                <div class="wordset">
                                    <ul>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                                    src="assets/img/icons/excel.svg" alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                                    src="assets/img/icons/printer.svg" alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  datanew ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach ($data['user'] as $user): ?>
                                            <tr>
                                                <td>
                                                    <?= $no++ ?>
                                                </td>
                                                <td>
                                                    <?= $user['nik'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['nama'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['no_hp'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['email'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['username'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['level'] ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('barang-ubah/' . $user['id']) ?>"
                                                        class="btn btn-warning"><i class="fa fa-edit"
                                                            data-bs-toggle="tooltip" title="Ubah Data"></i></a>
                                                    <a href="<?= route_to('delete_barang', $user['id']); ?>"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                            class="fa fa-trash" data-bs-toggle="tooltip"
                                                            title="Hapus"></i></a>
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