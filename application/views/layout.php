<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Peminjaman IT' ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/favico/favicon.ico'); ?>">
    <!-- Include Tailwind CSS -->
    <link href="<?= base_url('assets/tailwindcss/tailwind.min.css') ?>" rel="stylesheet" />
    <!-- jQuery -->
    <script src="<?= base_url('assets/bundle/jquery/jquery.min.js'); ?>"></script>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/sbadmin-2/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/sbadmin-2/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css"
        integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">
</head>
<style>
    aside {
        background-color: #4a90e2;
        /* Ganti dengan warna navbar Anda */
        color: white;
        /* Warna teks navbar */
        padding: 10px;
        /* Properti lain sesuai kebutuhan */
    }

    .container {
        margin-top: 20px;
    }
</style>

<body class="bg-gray-100">
    <!-- Header Section (can be a separate file included here) -->
    <?php if (isset($header)): ?>
        <header>
            <?php echo $header; ?>
        </header>
    <?php endif; ?>

    <!-- Sidebar -->
    <div class="flex justify-center">

        <?php if ($this->session->userdata('logged_in') == TRUE) {
            $this->load->view('component/sidebar');
        } ?>

        <!-- Main Content Section -->
        <div class="container flex-1">
            <div id="content">
                <?php if (isset($content)): ?>
                    <?php echo $content; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
<?php $this->load->view('component/sweetalert'); ?>
<!-- Sweetalert2 Dark Theme -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/sbadmin-2/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/sbadmin-2/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/sbadmin-2/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/sbadmin-2/'); ?>js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url('assets/sbadmin-2/'); ?>vendor/chart.js/Chart.min.js"></script>

<?php $this->load->view('js-inter/mostPart'); ?>

<script src="<?= base_url('assets/sbadmin-2/'); ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/sbadmin-2/'); ?>js/demo/chart-pie-demo.js"></script>

</html>