<?php
include '../layouts/admin_header.php';
include '../config/app.php';

// Mendapatkan ID buku dari parameter GET
$id_buku = (int)$_GET['id_buku'];
$buku = select("SELECT * FROM books WHERE id = $id_buku")[0];

// Ambil daftar kategori dari database
$categories = select("SELECT * FROM categories");

if (isset($_POST['edit_buku'])) {
    if (edit_buku($_POST, $id_buku, $_FILES) > 0) {
        echo "<script>
            alert('Anda berhasil edit');
            document.location.href = 'data_buku.php';
        </script>";
    } else {
        echo "<script>
            alert('Anda gagal edit');
            document.location.href = 'edit_buku.php?id_buku=$id_buku';
        </script>";
    }
}
?>

<section class="container mt-3">
    <h1 class="fw-semibold">Edit Data Buku</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_penulis" class="form-label">Nama Penulis</label>
            <input type="text" class="form-control" id="nama_penulis" name="nama_penulis" value="<?= htmlspecialchars($buku['nama_penulis']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select mb-3" id="kategori" name="id_category" required>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>" <?= $category['id'] == $buku['id_category'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="deskripsi_buku" class="form-label">Deskripsi Buku</label>
            <input type="text" class="form-control" id="deskripsi_buku" name="deskripsi_buku" value="<?= htmlspecialchars($buku['deskripsi_buku']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Buku</label>
            <input type="text" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($buku['harga']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Cover Buku</label>
            <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
            <?php if ($buku['cover']) : ?>
                <img src="../images/<?= htmlspecialchars($buku['cover']) ?>" alt="<?= htmlspecialchars($buku['cover']) ?>" width="100">
            <?php endif; ?>
        </div>
        <div class="d-flex flex-reverse gap-1">
            <a href="data_buku.php" class="btn btn-success w-50">Batal</a>
            <button type="submit" name="edit_buku" class="btn btn-primary w-50">Edit Data Buku</button>
        </div>
    </form>
</section>


<?php include '../layouts/footer.php' ?>