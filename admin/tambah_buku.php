<?php
include "../layouts/admin_header.php";
include "../config/app.php";

// Ambil daftar kategori dari database
$categories = select("SELECT * FROM categories");

if (isset($_POST['tambah_buku'])) {
    if (create_buku($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Anda berhasil membuat data');
            document.location.href = 'data_buku.php';
        </script>";
    } else {
        echo "<script>
            alert('Anda gagal membuat data');
            document.location.href = 'tambah_buku.php';
        </script>";
    }
}
?>

<section class="container mt-3">
    <h1 class="fw-semibold">Tambah Data Buku</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>
        <div class="mb-3">
            <label for="nama_penulis" class="form-label">Nama Penulis</label>
            <input type="text" class="form-control" id="nama_penulis" name="nama_penulis" required>
        </div>
        <label for="kategori" class="form-label">Kategori</label>
        <select class="form-select mb-3" aria-label="Default select example" id="kategori" name="id_category" required>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= htmlspecialchars($category['id']) ?>">
                    <?= htmlspecialchars($category['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class=" mb-3">
            <label for="deskripsi_buku" class="form-label">Deskripsi Buku</label>
            <input type="text" class="form-control" id="deskripsi_buku" name="deskripsi_buku" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Buku</label>
            <input type="text" class="form-control" id="harga" name="harga">
        </div>
        <div class=" mb-3">
            <label for="cover" class="form-label">Cover Buku</label>
            <input type="file" class="form-control" id="cover" name="cover" accept="image/*" required>
        </div>
        <div class="d-flex flex-reverse gap-1">
            <a href="data_buku.php" class="btn btn-success w-50">Batal</a>
            <button type="submit" name="tambah_buku" class="btn btn-primary w-50">Tambah Data Buku</button>
        </div>
    </form>
</section>

<?php include "../layouts/footer.php" ?>