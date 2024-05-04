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
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="<?= base_url('assets/bundle/jquery/jquery.min.js'); ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">
</head>
<style>
aside {
    background-color: #4a90e2; /* Ganti dengan warna navbar Anda */
    color: white; /* Warna teks navbar */
    padding: 10px;
    /* Properti lain sesuai kebutuhan */
}
.container {
    margin-top: 20px; 
}
</style>
<body class="bg-gray-100">
    <!-- Header Section (can be a separate file included here) -->
    <?php if (isset($header)) : ?>
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
        <div class="container flex-1 p-4">
            <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-24 lg:ml-64 p-4">
                <?php if (isset($content)) : ?>
                    <div id="content-wrapper">
                        <?php echo $content; ?> <!-- This will be replaced with specific content -->
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

    
    <!-- Footer Section (can be a separate file included here) -->
    <?php if (isset($footer)) : ?>
        <footer>
            <?php echo $footer; ?>
        </footer>
    <?php endif; ?>

</body>
<?php $this->load->view('component/sweetalert'); ?>
<!-- Sweetalert2 Dark Theme -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets/bundle/js/jquery.bundle.js?ver=1930'); ?>"></script>
<script src="<?= base_url('assets/bundle/js/scripts.js?ver=1930'); ?>"></script>

</html>