<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for animate css -->
    <link href="<?= base_url('assets/'); ?>css/animate.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-warning" style="min-height: 100vh;">

    <div class="container" style="min-height: 100vh;">

        <div class="flash-data" data-flashauth="<?= $this->session->flashdata('auth'); ?>"></div>

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0 h-50">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block p-1 border-right">
                                <img src="<?= base_url('assets/img/unikal.png'); ?>" alt="unika.png" class="img-fluid">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5 my-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <?= $this->session->flashdata('validasi-login'); ?>

                                    <form method="post" action="" class="user">
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Username" value="<?= set_value('username'); ?>">
                                            <?= form_error('username', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            <?= form_error('password', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <hr>
                                        <button name="submit" type="submit" class="btn btn-outline-warning btn-user btn-block font-weight-bold">
                                            Login
                                        </button>
                                    </form>
                                    <div class="text-center mt-3">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom sctipts for alert -->
    <script src="<?= base_url('assets/'); ?>js/sweetalert/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/alert.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>