<?= $this->extend('admin/layout/admin_layout'); ?>

<?= $this->section('content'); ?>

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
                <form method="post" action="<?= site_url('/masuk-history-store') ?>">
                    <div class="row">
                        <!-- <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tanggal Masuk </label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="YYYY-MM-DD" class="datetimepicker" name="tanggal_masuk" id="tanggal_masuk">
                                    <div class="addonset">
                                        <img src="assets/img/icons/calendars.svg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk">
                            </div>
                        </div>
                        <input type="hidden" name="inputer" id="inputer" value="<?= $userId ?>">
                    </div>
                    <div class="row data-data">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Barang</label>
                                <select class="select" name="kode_barang" id="kode_barang">
                                    <option selected disabled>Pilih Barang</option>
                                    <?php foreach($data['barang'] as $barang): ?>
                                    <option value="<?= $barang['kode_barang'] ?>"><?= $barang['nama_barang'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="text" name="jumlah" id="jumlah">
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