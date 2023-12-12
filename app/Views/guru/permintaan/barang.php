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
                <form method="post" action="<?= site_url('/permintaan-store') ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="transferlist.html" class="btn btn-cancel">Cancel</a>
                            <button class="btn btn-submit me-2">Submit</button>
                        </div>
                    </div>
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
                                        <th>Stok</th>
                                        <th>Foto</th>
                                        <th>Jumlah</th>
                                        <th>
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- inisialisasi variabel nomor -->
                                    <?php $no = 1 ?>
                                    <!-- memanggil data dari controller Barang function index dan menampilkan datanya menggunakan perulangan -->
                                    <?php foreach ($data['barang'] as $barang): ?>
                                        <tr>
                                            <input type="hidden" value="<?= $barang['kode_barang'] ?>" name="kode_barang" id="kode_barang">
                                            <td>
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                <?= $barang['nama_barang'] ?>
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
                                            <td>
                                                <?php $stokTersedia = $barang['stok_barang'] ?>
                                                    <?php if ($stokTersedia > 0): ?>
                                                        <input type="number" name="jumlah[]" id="jumlah" required>
                                                    <?php else: ?>
                                                        <input type="number" disabled>
                                                    <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php $stokTersedia = $barang['stok_barang'] ?>
                                                    <?php if ($stokTersedia > 0): ?>
                                                        <label class="checkboxs">
                                                            <input type="checkbox" name="barang_terpilih[]" value="<?= $barang['kode_barang']; ?>" required>
                                                            <span class="checkmarks"></span>
                                                        </label>
                                                    <?php else: ?>
                                                        <label class="checkboxs">
                                                            <input disabled>
                                                            <span class="checkmarks"></span>
                                                        </label>
                                                    <?php endif; ?>
                                            </td>
                                        </tr>
                                        <!-- Mengakhiri perulangan -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
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