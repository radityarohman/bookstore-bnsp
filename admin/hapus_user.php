<?php
include '../config/app.php';

$id_user = (int)$_GET['id_user'];

if (delete_user($id_user) > 0) {
    echo "<script>
            alert('Anda berhasil hapus');
            document.location.href = 'data_user.php';
        </script>";
} else {
    echo "<script>
            alert('Anda gagal hapus');
            document.location.href = 'data_user.php';
        </script>";
}
