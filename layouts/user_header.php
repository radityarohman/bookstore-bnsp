<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookLab | Website Penyedia Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Data tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap5.js">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="../admin/index.php">BookLab</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if (!isset($_SESSION['username'])) { ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'index.php') echo 'active'; ?>" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'about_us.php') echo 'active'; ?>" href="about_us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'contact_us.php') echo 'active'; ?>" href="contact_us.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'buku.php') echo 'active'; ?>" href="buku.php">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'kategori.php') echo 'active'; ?>" href="kategori.php">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'checkout.php') echo 'active'; ?>" href="checkout.php">Checkout</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'index.php') echo 'active'; ?>" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'about_us.php') echo 'active'; ?>" href="about_us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'contact_us.php') echo 'active'; ?>" href="contact_us.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'buku.php') echo 'active'; ?>" href="buku.php">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'kategori.php') echo 'active'; ?>" href="kategori.php">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'checkout.php') echo 'active'; ?>" href="checkout.php">Checkout</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
            <?php if (!isset($_SESSION['username'])) { ?>
                <a href="login.php" class="btn btn-primary me-2">Login</a>
                <a href="register.php" class="btn btn-primary me-2">Register</a>
            <?php } ?>

            <?php if ($current_page != 'search.php') { ?>
                <?php if (isset($_SESSION['username'])) { ?>
                    <a href="search.php" class="btn btn-primary">Search</a>
                <?php } else { ?>
                    <a href="#" class="btn btn-primary" onclick="alert('Anda harus login terlebih dahulu untuk lanjut'); return false;">Search</a>
                <?php } ?>
            <?php } ?>

            <?php if (isset($_SESSION['username'])) { ?>
                <a href="../logout.php" class="btn btn-danger ms-2">Logout</a>
            <?php } ?>
        </div>
    </nav>