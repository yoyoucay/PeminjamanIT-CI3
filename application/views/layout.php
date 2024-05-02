<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Peminjaman IT' ?></title>
    <!-- Include Tailwind CSS -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <!-- Custom styles -->
</head>

<body class="bg-gray-100">
    <!-- Header Section (can be a separate file included here) -->
    <?php if (isset($header)) : ?>
        <header>
            <?php echo $header; ?>
        </header>
    <?php endif; ?>

    <!-- Main Content Section -->
    <main>
        <?php if (isset($content)) : ?>
            <div id="content-wrapper">
                <?php echo $content; ?> <!-- This will be replaced with specific content -->
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer Section (can be a separate file included here) -->
    <?php if (isset($footer)) : ?>
        <footer>
            <?php echo $footer; ?>
        </footer>
    <?php endif; ?>

</body>

</html>