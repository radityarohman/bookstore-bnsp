<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include "../layouts/user_header.php";
include "../config/app.php";

$bukus = select("SELECT * FROM books");
?>

<div class="container mt-3">
    <table class="table table-striped" id="table">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Nama Penulis</th>
            <th scope="col">Harga Buku</th>
            <th scope="col">Action</th>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($bukus as $buku) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $buku['judul'] ?></td>
                    <td><?= $buku['nama_penulis'] ?></td>
                    <td>Rp. <?= htmlspecialchars(number_format($buku['harga'], 0, ',', '.')) ?></td>
                    <td>
                        <a href="buku_detail.php?id_buku=<?= $buku['id'] ?>" class="btn btn-success">Detail</a>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php">Kembali</a>
</div>

<?php include "../layouts/footer.php" ?>