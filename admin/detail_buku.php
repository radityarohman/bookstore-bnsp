<?php
include '../layouts/admin_header.php';
include '../config/app.php';

// Mendapatkan ID buku dari parameter GET
$id_buku = (int)$_GET['id_buku'];

$query = "
    SELECT books.judul, books.nama_penulis, books.deskripsi_buku, books.harga, books.cover, categories.nama AS category_name
    FROM books
    JOIN categories ON books.id_category = categories.id
    WHERE books.id = $id_buku
";

$buku = select($query)[0];
?>

<div class="container">
    <h1 class="text-center my-3">Detail Buku <?= htmlspecialchars($buku['judul']) ?></h1>
    <hr>
    <table class="table table-striped table-bordered">
        <tr>
            <td>Cover : </td>
            <td><img src="../images/<?= htmlspecialchars($buku['cover']) ?>" alt="<?= htmlspecialchars($buku['cover']) ?>" width="100"></td>
        </tr>
        <tr>
            <td>Judul : </td>
            <td><?= htmlspecialchars($buku['judul']) ?></td>
        </tr>
        <tr>
            <td>Nama Penulis:</td>
            <td><?= htmlspecialchars($buku['nama_penulis']) ?></td>
        </tr>
        <tr>
            <td>Deskripsi Buku:</td>
            <td><?= htmlspecialchars($buku['deskripsi_buku']) ?></td>
        </tr>
        <tr>
            <td>Harga Buku:</td>
            <td>Rp. <?= htmlspecialchars(number_format($buku['harga'], 0, ',', '.')) ?></td>
        </tr>
        <tr>
            <td>Kategori Buku:</td>
            <td><?= htmlspecialchars($buku['category_name']) ?></td>
        </tr>
    </table>
    <a href="data_buku.php">Kembali</a>
</div>

<?php
include '../layouts/footer.php';
?>