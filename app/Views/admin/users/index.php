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
                    <h4>List Pengguna</h4>
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
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data['users'] as $users):
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $no++ ?>
                                                </td>
                                                <td>
                                                    <?= $users['nik'] ?>
                                                </td>
                                                <td>
                                                    <?= $users['nama'] ?>
                                                </td>
                                                <td>
                                                    <?= $users['no_hp'] ?>
                                                </td>
                                                <td>
                                                    <?= $users['email'] ?>
                                                </td>
                                                <td>
                                                    <?= $users['username'] ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('users-ubah/' . $users['id']) ?>"
                                                        class="btn btn-warning"><i class="fa fa-edit"
                                                            data-bs-toggle="tooltip" title="Ubah Data"></i></a>
                                                    <a href="<?= route_to('delete_users', $users['id']) ?>"
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