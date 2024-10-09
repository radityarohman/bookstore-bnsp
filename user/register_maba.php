<?php
include '../layouts/user_header.php';
include "../config/app.php";

// if (isset($_POST['tambah_data'])) {
//     if (create_($_POST) > 0) {
//         echo "<script>
//             alert('Anda berhasil membuat data');
//             document.location.href = 'calon_maba.php';
//         </script>";
//     } else {
//         echo "<script>
//             alert('Anda gagal membuat data');
//             document.location.href = 'tambah_maba.php';
//         </script>";
//     }
// }

?>

<section class="container mt-3">
    <h1 class="fw-semibold">Tambah Data Camaba</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="ex: Raditya Ananda Rohman">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="ex: Jln. Pegangsaan Timur">
        </div>
        <div class="mb-3">
            <label for="no_telepon" class="form-label">No Telepon</label>
            <input type="no_telepon" class="form-control" id="no_telepon" name="no_telepon" placeholder="ex: 08123456789">
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <input type="jenis_kelamin" class="form-control" id="jenis_kelamin" name="jenis_kelamin" placeholder="Laki - Laki/Perempuan">
        </div>
        <button type="submit" name="tambah_data" class="btn btn-primary w-100">Tambah Data</button>
    </form>
</section>

<?php include "../layouts/footer.php" ?>