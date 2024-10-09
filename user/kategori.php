<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

include "../layouts/user_header.php";
include "../config/app.php";

$categories = select("SELECT * FROM categories");
?>

<div class="container mt-3">
    <h1>Data Kategori</h1>
    <hr>
    <table class="table table-striped">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Nama Kategori</th>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><a href="buku_kategori.php?id_kategori=<?= $category['id'] ?>"><?= $category['nama'] ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php">Kembali</a>
</div>

<?php include "../layouts/footer.php" ?>