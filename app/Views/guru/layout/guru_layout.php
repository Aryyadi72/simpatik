<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>
        <?= $title['title'] ?>
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/favicon1.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>">
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css">
</head>

<body>
    <?= $this->include('guru/layout/guru_header'); ?>
    <?= $this->include('guru/layout/guru_sidebar'); ?>
    <?= $this->renderSection('guru-content'); ?>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/plugins/fileupload/fileupload.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
            <script>
                $(document).ready(function() {
                    var url = window.location.href;
                    
                    // Menghapus class 'active' dari semua item menu
                    $('#sidebar-menu li').removeClass('active');
                    
                    // Menambahkan class 'active' ke item menu yang dipilih berdasarkan URL
                    $('#sidebar-menu a').each(function() {
                        // Memeriksa apakah URL cocok dengan URL pada item menu
                        if (this.href === url) {
                            // Menambahkan class 'active' ke parent 'li' dari item menu yang cocok
                            $(this).closest('li').addClass('active');
                            
                            // Untuk submenu: Menambahkan class 'active' ke parent '.submenu'
                            $(this).parents('.submenu').addClass('active');
                        }
                    });
                });
            </script>
            <script>
                $(function(){
                    <?php if(session()->has("success")) { ?>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '<?= session("success") ?>'
                        })
                    <?php } ?>
                });
            </script>
            <script>
                $(function(){
                    <?php if(session()->has("error")) { ?>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: '<?= session("error") ?>'
                        })
                    <?php } ?>
                });
            </script>
</body>

</html>