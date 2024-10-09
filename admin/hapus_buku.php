<?php
include '../config/app.php';

$id_buku = (int)$_GET['id_buku'];

if (delete_buku($id_buku) > 0) {
    echo "<script>
            alert('Anda berhasil hapus');
            document.location.href = 'data_buku.php';
        </script>";
} else {
    echo "<script>
            alert('Anda gagal hapus');
            document.location.href = 'data_buku.php';
        </script>";
}
