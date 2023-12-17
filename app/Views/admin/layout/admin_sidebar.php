<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="<?= base_url('/') ?>"><img src="<?= base_url() ?>assets/img/icons/dashboard.svg"
                            alt="img"><span>
                            Dashboard</span> </a>
                </li>
                <li>
                    <a href="<?= base_url('users') ?>"><img src="assets/img/icons/users1.svg" alt="img"><span>
                            Pengguna</span> </a>
                </li>
                <li>
                    <a href="<?= base_url('barang') ?>"><img src="<?= base_url() ?>assets/img/icons/product.svg"
                            alt="img"><span>
                            Barang</span> </a>
                </li>
                <li>
                    <a href="<?= base_url('permintaan-masuk') ?>"><img
                            src="<?= base_url() ?>assets/img/icons/transfer1.svg" alt="img"><span> Permintaan
                            Masuk</span> </a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="file"></i><span> Riwayat</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="<?= base_url('masuk-history') ?>">Riwayat Barang Masuk</a></li>
                        <li><a href="<?= base_url('keluar-history') ?>">Riwayat Barang Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>