<?= $this->extend('guru/layout/guru_layout'); ?>

<?= $this->section('guru-content'); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Permintaan Barang</h4>
                <h6>Tambahkan permintaan barang.</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Pilih Barang</label>
                                <select class="select">
                                    <option selected disabled>Pilih Barang</option>
                                    <?php foreach ($data['barang'] as $barang): ?>
                                        <option>
                                            <?= $barang['nama_barang'] ?> |
                                            <?= $barang['stok_barang'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bor-b1">

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 float-md-right">
                            <div class="total-order">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="javascript:void(0);" class="btn btn-submit me-2">Submit</a>
                            <a href="transferlist.html" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
                <hr>
                <br>
                <div class="row">
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
                                    <th>Barang</th>
                                    <th>Jenis</th>
                                    <th>Stok</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- inisialisasi variabel nomor -->
                                <?php $no = 1 ?>
                                <!-- memanggil data dari controller Barang function index dan menampilkan datanya menggunakan perulangan -->
                                <?php foreach ($data['barang'] as $barang): ?>
                                    <tr>
                                        <td>
                                            <?= $no++ ?>
                                        </td>
                                        <td>
                                            <?= $barang['nama_barang'] ?>
                                        </td>
                                        <td>
                                            <?= $barang['jenis_barang'] ?>
                                        </td>
                                        <td>
                                            <?= $barang['stok_barang'] ?>
                                        </td>
                                        <td>
                                            <!-- Menampilkan gambar yang sudah di upload kedalam database -->
                                            <?php if (!empty($barang['foto_barang'])): ?>
                                                <img src="<?= base_url($barang['foto_barang']) ?>" alt="Foto Barang" width="50">
                                            <?php else: ?>
                                                <span>No Image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php $stokTersedia = $barang['stok_barang'] ?>
                                            <?php if ($stokTersedia > 0): ?>
                                                <a href="" class="btn btn-info" id="tambahBarangBtn"><i
                                                        class="fa fa-shopping-cart" data-bs-toggle="tooltip"
                                                        title="Tambah"></i></a>
                                            <?php else: ?>
                                                <button class="btn btn-danger" disabled><i class="fa fa-shopping-cart"
                                                        data-bs-toggle="tooltip" title="Stok Habis"></i></button>
                                            <?php endif; ?>
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

<script>
    document.getElementById('tambahBarangBtn').addEventListener('click', function () {
        // Dapatkan nilai nama barang dan jumlah dari data barang yang dipilih
        var namaBarang = "nama_barang";  // Gantilah dengan nilai sebenarnya

        // Buat elemen <tr> baru
        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${namaBarang}</td>
            <td>
                <div class="input-group form-group mb-0">
                    <a class="scanner-set input-group-text">
                        <img src="<?= base_url('assets/img/icons/plus1.svg') ?>" alt="img">
                    </a>
                    <input type="text" value="0" class="calc-no">
                        <a class="scanner-set input-group-text">
                            <img src="<?= base_url('assets/img/icons/minus.svg') ?>" alt="img">
                        </a>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);" class="delete-set"><img
                    src="<?= base_url('assets/img/icons/delete.svg') ?>" alt="svg"></a>
            </td>
        `;

        // Masukkan elemen <tr> baru ke dalam tabel
        var tableBody = document.querySelector('.table tbody');
        tableBody.appendChild(newRow);
    });
</script>

<?= $this->endSection(); ?>