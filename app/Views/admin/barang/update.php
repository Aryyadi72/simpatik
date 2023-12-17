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
                <h4>Tambah Barang</h4>
                <h6>Form tambah barang</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Digunakan pada form yang memerlukan upload file/gambar -->
                <form action="<?= base_url('barang-update') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="<?= $data['barang']['id'] ?>">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang"
                                    value="<?= $data['barang']['nama_barang'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <select class="select" name="jenis_barang" id="jenis_barang">
                                    <option selected disabled>Pilih Jenis Barang</option>
                                    <option value="Alat Tulis" <?= ($data['barang']['jenis_barang'] == 'Alat Tulis') ? 'selected' : ''; ?>>Alat Tulis</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                <label>Upload (Single File) <a href="javascript:void(0)"
                                        class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file">
                                    <input type="file" name="foto_barang"
                                        class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview">
                                    <?php if (!empty($data['barang']['foto_barang'])): ?>
                                        <img src="<?= base_url($data['barang']['foto_barang']); ?>" alt="Preview Image"
                                            style="height:200px;width:200px;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-submit me-2" value="submit">
                            <a href="<?= base_url('barang') ?>" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Mengakhiri inisialisasi content pada halaman ini -->
<?= $this->endSection(); ?>