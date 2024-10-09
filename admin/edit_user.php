<?php
include '../layouts/admin_header.php';
include '../config/app.php';

// Mendapatkan ID user dari parameter GET
$id_user = (int)$_GET['id_user'];

// Mengambil data user dari database
$user = select("SELECT * FROM users WHERE id = $id_user")[0];

// Memproses form jika tombol 'edit_user' ditekan
if (isset($_POST['edit_user'])) {
    if (edit_user($_POST, $id_user) > 0) {
        echo "<script>
            alert('Anda berhasil edit');
            document.location.href = 'data_user.php';
        </script>";
    } else {
        echo "<script>
            alert('Anda gagal edit');
            document.location.href = 'edit_user.php?id_user=$id_user';
        </script>";
    }
}
?>

<div class="container mt-3">
    <h1 class="fw-semibold">Edit Data User</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="******">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
        </div>
        <div class="d-flex flex-reverse gap-1">
            <a href="data_user.php" class="btn btn-success w-50">Batal</a>
            <button type="submit" name="edit_user" class="btn btn-primary w-50">Edit Data User</button>
        </div>
    </form>
</div>

<?php include '../layouts/footer.php' ?>