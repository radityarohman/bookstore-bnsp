<?php
include "layouts/header.php";
include "config/app.php";

if (isset($_POST['register'])) {
    if (create_user($_POST) > 0) {
        echo "<script>
            alert('Anda berhasil registrasi');
            document.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert('Anda gagal registrasi');
            document.location.href = 'register.php';
        </script>";
    }
}
?>

<section class="container vh-100 d-flex flex-column justify-content-center align-items-center">
    <h1 class="fw-semibold">Register</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="ex: Raditya Ananda Rohman" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="ex: Radit" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="ex: a@gmail.com" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="***" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
</section>

<?php include "layouts/footer.php" ?>