<?php
session_start();
include '../config/app.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$book_id = (int)$_GET['book_id'];

// Cek apakah buku sudah ada di keranjang
$check = select("SELECT * FROM carts WHERE user_id = $user_id AND book_id = $book_id");
if (count($check) > 0) {
    // Update quantity jika sudah ada
    $query = "UPDATE carts SET quantity = quantity + 1 WHERE user_id = $user_id AND book_id = $book_id";
} else {
    // Insert buku baru ke keranjang
    $query = "INSERT INTO carts (user_id, book_id, quantity) VALUES ($user_id, $book_id, 1)";
}

mysqli_query($db, $query);

header('Location: checkout.php');
