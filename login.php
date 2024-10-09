<?php
include "layouts/header.php";
include "config/app.php";

if (isset($_POST['login'])) {
    $login_result = login($_POST);
    if ($login_result) {
        $username = $login_result['username'];
        $role = $login_result['role'];

        $redirect_url = ($role == 'admin') ? 'admin/index.php' : 'user/index.php';

        echo "<script>
            alert('Selamat datang $username');
            document.location.href = '$redirect_url';
        </script>";
    } else {
        echo "<script>
            alert('Login gagal. Silakan cek kembali username dan password Anda.');
            document.location.href = 'login.php';
        </script>";
    }
}
?>

<section class="container vh-100 d-flex flex-column justify-content-center align-items-center">
    <h1 class="fw-semibold">Login</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="ex: radit">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="***">
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="mt-3">Belum punya akun? <a href="register.php">Register</a></p>
</section>

<?php include "layouts/footer.php" ?>