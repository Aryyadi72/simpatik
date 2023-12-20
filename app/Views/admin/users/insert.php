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

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Tambah Pengguna</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="post" action="<?= site_url('/users-store') ?>">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" required>
                            </div>
                        </div>

                        <div class="col-lg-5 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" required>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="no_hp" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Level</label>
                                <select class="select" name="level" required>
                                    <option selected disabled>Pilih Level</option>
                                    <option value="admin">Admin</option>
                                    <option value="guru">Guru</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <a href="<?= base_url('users') ?>" class="btn btn-cancel">Cancel</a>
                            <input type="submit" class="btn btn-submit me-2" value="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Mengakhiri inisialisasi content pada halaman ini -->
<?= $this->endSection(); ?>