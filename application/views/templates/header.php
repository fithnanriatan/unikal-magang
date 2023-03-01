<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> - Magang Unikal</title>

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for serverside-->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">
    
    <!-- Custom styles for mine -->
    <link rel="stylesheet" href="<?= base_url('assets/css/mystyle.css'); ?>">
    
    <!-- Custom styles for animate css -->
    <link href="<?= base_url('assets/'); ?>css/animate.min.css" rel="stylesheet">


</head>

<body id="page-top">
    
    <div id="base-url" name="base-url" class="base-url" data-url="<?= base_url(); ?>"></div>

    <div name="flashdata" class="flash-data" data-flashmain="<?= $this->session->flashdata('main'); ?>" data-flashauth="<?= $this->session->flashdata('auth'); ?>" data-flasheror="<?= $this->session->flashdata('error'); ?>"></div>

    <!-- Page Wrapper -->
    <div id="wrapper">