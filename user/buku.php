<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
include "../layouts/user_header.php";
include "../config/app.php";

$query = "SELECT * FROM books";
$bukus = select($query);
?>

<div class="container mt-3">
    <div class="text-center mb-3">
        <h1>Buku - Buku</h1>
    </div>
    <div class="row g-3">
        <?php foreach ($bukus as $buku) : ?>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                <div class="card" style="width: 100%;">
                    <img src="../images/<?= $buku['cover'] ?>" class="card-img-top" alt="<?= $buku['judul'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $buku['judul'] ?></h5>
                        <p class="card-text"><?= $buku['deskripsi_buku'] ?></p>
                        <a href="buku_detail.php?id_buku=<?= $buku['id'] ?>" class="btn btn-primary">Detail</a>
                        <a href="add_to_cart.php?book_id=<?= $buku['id'] ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="index.php" class="my-4">Kembali</a>
</div>