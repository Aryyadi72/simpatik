<?= $this->extend('admin/layout/admin_layout'); ?>

<?= $this->section('content'); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Konfirmasi Permintaan</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Digunakan pada form yang memerlukan upload file/gambar -->
                <form method="post" action="<?= base_url('permintaan-masuk-detail-diproses-edit/'.$data['permintaan']['id']) ?>">
                    <input type="hidden" name="id" id="id" value="<?= $data['permintaan']['id'] ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" name="status" id="status" value="diproses">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="(Isi keterangan disini)" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row data-data">
                        <div class="col-lg-12">
                            <a href="<?= base_url('permintaan-masuk') ?>" class="btn btn-cancel">Cancel</a>
                            <input type="submit" name="submit" class="btn btn-submit me-2" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Mengakhiri inisialisasi content pada halaman ini -->
<?= $this->endSection(); ?>
