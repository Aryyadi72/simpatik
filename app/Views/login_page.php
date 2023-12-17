<!doctype html>
<html lang="en">

<head>
    <title>Login - SIMPATIK</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/favicon1.png') ?>">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>login_assets/css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login SIMPATIK</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <img src="<?= base_url() ?>login_assets/images/logo_sekolah.jpg" alt="" width="100"
                                height="100">
                        </div>
                        <h3 class="text-center mb-4">Login</h3>
                        <form method="post" action="<?= site_url('auth-processLogin'); ?>" class="login-form">
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Username"
                                    name="username" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Password"
                                    name="password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                    class="form-control btn btn-primary rounded submit px-3">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url() ?>login_assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>login_assets/js/popper.js"></script>
    <script src="<?= base_url() ?>login_assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>login_assets/js/main.js"></script>

</body>

</html>