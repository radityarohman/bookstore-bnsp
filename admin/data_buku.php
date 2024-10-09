<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include "../layouts/admin_header.php";
include "../config/app.php";

$bukus = select("SELECT * FROM books");
?>

<div class="container mt-3">
    <h1>Data Buku</h1>
    <a href="tambah_buku.php" class="btn btn-primary">Tambah Buku</a>
    <hr>
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
                        <a href="detail_buku.php?id_buku=<?= $buku['id'] ?>" class="btn btn-success">Detail</a>
                        <a href="edit_buku.php?id_buku=<?= $buku['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="hapus_buku.php?id_buku=<?= $buku['id'] ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../layouts/footer.php" ?>