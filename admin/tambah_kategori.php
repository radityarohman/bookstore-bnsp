<?php
include "../layouts/admin_header.php";
include "../config/app.php";

if (isset($_POST['tambah_kategori'])) {
    if (create_kategori($_POST) > 0) {
        echo "<script>
            alert('Anda berhasil membuat data');
            document.location.href = 'kategori_buku.php';
        </script>";
    } else {
        echo "<script>
            alert('Anda gagal membuat data');
            document.location.href = 'tambah_kategori.php';
        </script>";
    }
}

?>

<section class="container mt-3">
    <h1 class="fw-semibold">Tambah Kategori Buku</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">
        </div>
        <div class="mb-3">
            <label for="deskripsi_kategori" class="form-label">Deskripsi Kategori</label>
            <input type="text" class="form-control" id="deskripsi_kategori" name="deskripsi_kategori">
        </div>

        <div class="d-flex flex-reverse gap-1">
            <a href="kategori_buku.php" class="btn btn-success w-50">Batal</a>
            <button type="submit" name="tambah_kategori" class="btn btn-primary w-50">Tambah Kategori Buku</button>
        </div>
    </form>
</section>

<?php include "../layouts/footer.php" ?>