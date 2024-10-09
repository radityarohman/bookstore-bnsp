<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include "../layouts/user_header.php";
include "../config/app.php";

$id_kategori = isset($_GET['id_kategori']) ? (int)$_GET['id_kategori'] : 0;

// Ambil data buku berdasarkan kategori
$bukus = select("SELECT * FROM books WHERE id_category = $id_kategori");

// Cek apakah kategori ada
$kategori_query = select("SELECT nama FROM categories WHERE id = $id_kategori");
$kategori = $kategori_query ? $kategori_query[0] : ['nama' => 'Kategori Tidak Ditemukan'];
?>

<div class="container mt-3">
    <h1>Buku di Kategori: <?= htmlspecialchars($kategori['nama']) ?></h1>
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
            <?php if (empty($bukus)) : ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada buku di kategori ini.</td>
                </tr>
            <?php else : ?>
                <?php $no = 1 ?>
                <?php foreach ($bukus as $buku) : ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= htmlspecialchars($buku['judul']) ?></td>
                        <td><?= htmlspecialchars($buku['nama_penulis']) ?></td>
                        <td>Rp. <?= htmlspecialchars(number_format($buku['harga'], 0, ',', '.')) ?></td>
                        <td>
                            <a href="buku_detail.php?id_buku=<?= $buku['id'] ?>" class="btn btn-success">Detail</a>
                            <a href="add_to_cart?id_buku=<?= $buku['id'] ?>" class="btn btn-primary">Add to cart</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="kategori.php">Kembali</a>
</div>

<?php include "../layouts/footer.php" ?>