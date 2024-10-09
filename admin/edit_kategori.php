<?php
include '../layouts/admin_header.php';
include '../config/app.php';

$id_kategori = (int)$_GET['id_kategori'];
$kategori = select("SELECT * FROM categories WHERE id = $id_kategori")[0];

if (isset($_POST['edit_kategori'])) {
    if (edit_kategori($_POST, $id_kategori) > 0) {
        echo "<script>
            alert('Anda berhasil edit');
            document.location.href = 'kategori_buku.php';
        </script>";
    } else {
        echo "<script>
            alert('Anda gagal edit');
            document.location.href = 'edit_kategori.php?id_kategori=$id_kategori';
        </script>";
    }
}

?>

<div class="container mt-3">
    <h1 class="fw-semibold">Edit Kategori Buku</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($kategori['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Kategori</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= htmlspecialchars($kategori['deskripsi']) ?>" required>
        </div>
        <div class="d-flex flex-reverse gap-1">
            <a href="kategori_buku.php" class="btn btn-success w-50">Batal</a>
            <button type="submit" name="edit_kategori" class="btn btn-primary w-50">Edit Kategori Buku</button>
        </div>
    </form>
</div>

<?php include '../layouts/footer.php' ?>