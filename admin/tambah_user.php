<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include "../layouts/admin_header.php";
include "../config/app.php";

if (isset($_POST['tambah_user'])) {
    if (create_user($_POST) > 0) {
        echo "<script>
            alert('Anda berhasil membuat data user');
            document.location.href = 'data_user.php';
        </script>";
    } else {
        echo "<script>
            alert('Anda gagal membuat data user');
            document.location.href = 'tambah_user.php';
        </script>";
    }
}
?>

<section class="container mt-3">
    <h1 class="fw-semibold">Tambah Data User</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-flex flex-reverse gap-1">
            <a href="data_user.php" class="btn btn-success w-50">Batal</a>
            <button type="submit" name="tambah_user" class="btn btn-primary w-50">Tambah User</button>
        </div>
    </form>
</section>

<?php include "../layouts/footer.php" ?>