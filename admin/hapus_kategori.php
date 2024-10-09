<?php
include '../config/app.php';

$id_kategori = (int)$_GET['id_kategori'];

if (delete_kategori($id_kategori) > 0) {
    echo "<script>
            alert('Anda berhasil hapus');
            document.location.href = 'kategori_buku.php';
        </script>";
} else {
    echo "<script>
            alert('Anda gagal hapus');
            document.location.href = 'kategori_buku.php';
        </script>";
}
