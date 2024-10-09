<?php

// Register
function create_user($post)
{
    global $db;

    $nama = $post['nama'];
    $username = $post['username'];
    $email = $post['email'];
    $password = $post['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (nama, username, email, password, role)
              VALUES ('$nama', '$username', '$email', '$hashed_password', 'user')";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function edit_user($post, $id)
{
    global $db;

    // Ambil data dari form
    $nama = mysqli_real_escape_string($db, $post['nama']);
    $username = mysqli_real_escape_string($db, $post['username']);
    $email = mysqli_real_escape_string($db, $post['email']);
    $password = !empty($post['password']) ? mysqli_real_escape_string($db, password_hash($post['password'], PASSWORD_DEFAULT)) : null;

    // Jika password diubah, update password, jika tidak, update data tanpa password
    if ($password) {
        $query = "UPDATE users SET
                  nama = '$nama',
                  username = '$username',
                  email = '$email',
                  password = '$password'
                  WHERE id = $id";
    } else {
        $query = "UPDATE users SET
                  nama = '$nama',
                  username = '$username',
                  email = '$email'
                  WHERE id = $id";
    }

    // Eksekusi query
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_user($id)
{
    global $db;

    $query = "DELETE FROM users WHERE id = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Login 
function login($post)
{
    global $db;
    $username = $post['username'];
    $password = $post['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // set session
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['id'];  // Menyimpan user_id ke dalam session

            return [
                'username' => $user['username'],
                'role' => $user['role']
            ];
        } else {
            return false;
        }
        // if (password_verify($password, '$2y$10$Y8dirzA3/ohEi92FRlw67eCvrQeIVWEWslnumGDaZAGY2ZDGYVuju')) {
        //     echo "Password sama";
        // } else {
        //     echo "Password beda";
        // }
    } else {
        return false;
    }
}

function select($query)
{
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// create maba
function create_buku($post, $file)
{
    global $db;

    $judul = $post['judul'];
    $nama_penulis = $post['nama_penulis'];
    $deskripsi_buku = $post['deskripsi_buku'];
    $harga = $post['harga'];
    $id_category = (int)$post['id_category'];

    // Mengelola upload file
    $cover = $file['cover'];
    $cover_name = null;

    if ($cover['error'] === UPLOAD_ERR_OK) {
        $cover_tmp_name = $cover['tmp_name'];
        $cover_name = basename($cover['name']);
        $upload_dir = '../images/';

        // Pindahkan file yang diupload ke direktori tujuan
        if (move_uploaded_file($cover_tmp_name, $upload_dir . $cover_name)) {
            // Berhasil mengupload
        } else {
            $cover_name = null;
        }
    }

    $query = "INSERT INTO books (judul, nama_penulis, deskripsi_buku, harga, cover, id_category)
              VALUES ('$judul', '$nama_penulis', '$deskripsi_buku', '$harga', '$cover_name', $id_category)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function edit_buku($post, $id, $file)
{
    global $db;

    // Ambil data dari POST
    $judul = isset($post['judul']) ? $post['judul'] : '';
    $nama_penulis = isset($post['nama_penulis']) ? $post['nama_penulis'] : '';
    $deskripsi_buku = isset($post['deskripsi_buku']) ? $post['deskripsi_buku'] : '';
    $harga = isset($post['harga']) ? $post['harga'] : '';
    $id_category = isset($post['id_category']) ? (int)$post['id_category'] : 0;

    // Validasi ID kategori
    $valid_category = select("SELECT id FROM categories WHERE id = $id_category");
    if (empty($valid_category)) {
        return 0; // ID kategori tidak valid
    }

    // Mengelola upload file
    $cover = isset($file['cover']) ? $file['cover'] : null;
    $cover_name = null;

    // Ambil nama file cover saat ini
    $current_buku = select("SELECT cover FROM books WHERE id = $id")[0];
    $current_cover = $current_buku['cover'];

    if ($cover && $cover['error'] === UPLOAD_ERR_OK) {
        $cover_tmp_name = $cover['tmp_name'];
        $cover_name = basename($cover['name']);
        $upload_dir = '../images/'; // Sesuaikan dengan direktori penyimpanan gambar

        // Pindahkan file yang diupload ke direktori tujuan
        if (move_uploaded_file($cover_tmp_name, $upload_dir . $cover_name)) {
            // Jika berhasil upload, hapus cover lama jika ada
            if ($current_cover && file_exists($upload_dir . $current_cover)) {
                unlink($upload_dir . $current_cover);
            }
        } else {
            $cover_name = $current_cover; // Gunakan cover lama jika gagal upload
        }
    } else {
        $cover_name = $current_cover; // Gunakan cover lama jika tidak ada file baru
    }

    $query = "UPDATE books SET
              judul = '$judul',
              nama_penulis = '$nama_penulis',
              deskripsi_buku = '$deskripsi_buku',
              harga = '$harga',
              cover = '$cover_name',
              id_category = $id_category
              WHERE id = $id
    ";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}



function delete_buku($id)
{
    global $db;

    $query = "DELETE FROM books WHERE id = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function create_kategori($post)
{
    global $db;

    $nama = $post['nama_kategori'];
    $deskripsi = $post['deskripsi_kategori'];

    $query = "INSERT INTO categories (nama, deskripsi)
    VALUES ('$nama','$deskripsi')
    ";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function edit_kategori($post, $id)
{
    global $db;

    $nama = $post['nama'];
    $deskripsi = $post['deskripsi'];

    $query = "UPDATE categories SET
        nama = '$nama',
        deskripsi = '$deskripsi'
        WHERE id = $id
    ";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_kategori($id)
{
    global $db;

    $query = "DELETE FROM categories WHERE id = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
