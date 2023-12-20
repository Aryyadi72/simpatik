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
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Digunakan pada form yang memerlukan upload file/gambar -->
                <?= form_open_multipart('barang-store') ?>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang">
                        </div>
                    </div>
                    <input type="hidden" name="jenis_barang" id="jenis_barang" value="Alat Tulis">
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
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a href="<?= base_url('barang') ?>" class="btn btn-cancel">Cancel</a>
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