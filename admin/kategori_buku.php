<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include "../layouts/admin_header.php";
include "../config/app.php";

$categories = select("SELECT * FROM categories");
?>

<div class="container mt-3">
    <h1>Data Kategori</h1>
    <a href="tambah_kategori.php" class="btn btn-primary">Tambah Kategori</a>
    <hr>
    <table class="table table-striped" id="table">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Nama Kategori</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Action</th>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $category['nama'] ?></td>
                    <td><?= $category['deskripsi'] ?></td>
                    <td>
                        <a href="edit_kategori.php?id_kategori=<?= $category['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="hapus_kategori.php?id_kategori=<?= $category['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus Data?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../layouts/footer.php" ?>