<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="<?= base_url('dash-admin') ?>"><img src="<?= base_url() ?>assets/img/icons/dashboard.svg" alt="img"><span>
                            Dashboard</span> </a>
                </li>
                <li>
                    <a href="<?= base_url('permintaan-masuk') ?>"><img src="<?= base_url() ?>assets/img/icons/transfer1.svg"
                            alt="img"><span> Permintaan Masuk</span> </a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="layers"></i><span> Master</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="<?= base_url('barang') ?>">Barang</a></li>
                        <li><a href="<?= base_url('users') ?>">User</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="<?= base_url() ?>assets/img/icons/product.svg" alt="img"><span> Barang</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="<?= base_url('masuk-history-add') ?>">Form Barang Masuk</a></li>
                        <li><a href="<?= base_url('masuk-history') ?>">Riwayat Barang Masuk</a></li>
                        <li><a href="<?= base_url('keluar-history') ?>">Riwayat Barang Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>