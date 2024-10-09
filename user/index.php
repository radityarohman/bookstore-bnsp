<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

include "../layouts/user_header.php";

?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1>Selamat datang <?= $_SESSION['username'] ?></h1>
        <p>Selamat datang di BookLab</p>
    </div>
</div>