<?= $this->extend('admin/layout/admin_layout'); ?>

<?= $this->section('content'); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Konfirmasi Permintaan</h4>
                <h6>Form konfirmasi permintaan barang</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Digunakan pada form yang memerlukan upload file/gambar -->
                <form method="post" action="<?= base_url('permintaan-masuk-detail-selesai-edit/'.$data['permintaan']['id']) ?>">
                    <input type="hidden" name="id" id="id" value="<?= $data['permintaan']['id'] ?>">
                    <input type="hidden" name="kode_barang" id="kode_barang" value="<?= $data['permintaan']['kode_barang'] ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" name="status" id="status" value="disetujui" readonly>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan"><?= $data['permintaan']['keterangan'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row data-data">
                        <div class="col-lg-12">
                            <input type="submit" name="submit" class="btn btn-submit me-2" value="Submit">
                            <a href="<?= base_url('permintaan-masuk') ?>" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Mengakhiri inisialisasi content pada halaman ini -->
<?= $this->endSection(); ?>
