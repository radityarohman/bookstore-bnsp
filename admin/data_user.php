<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include "../layouts/admin_header.php";
include "../config/app.php";

$users = select("SELECT * FROM users");
?>

<div class="container mt-3">
    <h1>Data User</h1>
    <a href="tambah_user.php" class="btn btn-primary">Tambah User</a>
    <hr>
    <table class="table table-striped" id="table">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $user['nama'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['password'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td>
                        <a href="edit_user.php?id_user=<?= $user['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="hapus_user.php?id_user=<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus Data?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../layouts/footer.php" ?>