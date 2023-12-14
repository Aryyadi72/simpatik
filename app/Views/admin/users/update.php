<!-- menghubungkan tampilan ini dengan tampilan admin layout -->
<?= $this->extend('admin/layout/admin_layout');?>
<!-- Menginisialisasi bahwa halaman ini adalah content -->
<?= $this->section('content');?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Tambah User</h4>
                <h6>Form tambah user</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="<?= site_url('users-update') ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $data['users']['id'] ?>">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" value="<?= $data['users']['nik'] ?>" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" value="<?= $data['users']['nama'] ?>">
                            </div>
                        </div>

                        <div class="col-lg-5 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="<?= $data['users']['email'] ?>">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="no_hp" value="<?= $data['users']['no_hp'] ?>">
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Level</label>
                                <select class="select" name="level" required>
                                    <option selected disabled>Pilih Level</option>
                                    <option value="admin" <?= ($data['users']['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="guru" <?= ($data['users']['level'] == 'guru') ? 'selected' : ''; ?>>Guru</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="<?= $data['users']['username'] ?>">
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" value="<?= $data['users']['password'] ?>">
                            </div>
                        </div>

                        <div class="col-lg-12">
                        <input type="submit" class="btn btn-submit me-2" value="submit">
                            <a href="<?= base_url('users') ?>" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Mengakhiri inisialisasi content pada halaman ini -->
<?= $this->endSection();?>