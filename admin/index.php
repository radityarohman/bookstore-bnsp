<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include '../layouts/admin_header.php';
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1>Selamat datang min!</h1>
    </div>
</div>

<?php include '../layouts/footer.php' ?>