<?php
session_start();
include '../config/app.php';
include '../layouts/user_header.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$book_id = isset($_GET['book_id']) ? (int)$_GET['book_id'] : null;
$action = $_GET['action'] ?? null;

if ($action === 'add') {
    $query = "UPDATE carts SET quantity = quantity + 1 WHERE user_id = $user_id AND book_id = $book_id";
} elseif ($action === 'reduce') {
    $query = "UPDATE carts SET quantity = quantity - 1 WHERE user_id = $user_id AND book_id = $book_id AND quantity > 1";
} elseif ($action === 'delete') {
    $query = "DELETE FROM carts WHERE user_id = $user_id AND book_id = $book_id";
}

if ($action) {
    if (mysqli_query($db, $query)) {
        header('Location: checkout.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($db);
    }
}

$carts = select("SELECT c.*, b.judul, b.harga FROM carts c JOIN books b ON c.book_id = b.id WHERE c.user_id = $user_id");

if (isset($_POST['place_order'])) {
    $query = "INSERT INTO orders (user_id, status, created_at) VALUES ($user_id, 'pending', NOW())";
    if (mysqli_query($db, $query)) {
        $order_id = mysqli_insert_id($db);

        foreach ($carts as $cart) {
            $query = "INSERT INTO orders_detail (order_id, book_id, quantity, price) VALUES ($order_id, {$cart['book_id']}, {$cart['quantity']}, {$cart['harga']})";
            if (!mysqli_query($db, $query)) {
                echo "Error: " . mysqli_error($db);
                exit;
            }
        }

        $query = "DELETE FROM carts WHERE user_id = $user_id";
        if (mysqli_query($db, $query)) {
            header('Location: payment.php?order_id=' . $order_id);
            exit;
        } else {
            echo "Error: " . mysqli_error($db);
        }
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>

<div class="container mt-3">
    <h1>Checkout</h1>
    <table class="table table-striped">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
            <th scope="col">Action</th>
        </thead>
        <tbody>
            <?php $no = 1;
            $total = 0; ?>
            <?php foreach ($carts as $cart) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= htmlspecialchars($cart['judul']) ?></td>
                    <td>Rp. <?= htmlspecialchars(number_format($cart['harga'], 0, ',', '.')) ?></td>
                    <td><?= $cart['quantity'] ?></td>
                    <td>Rp. <?= htmlspecialchars(number_format($cart['quantity'] * $cart['harga'], 0, ',', '.')) ?></td>
                    <td>
                        <a href="checkout.php?book_id=<?= $cart['book_id'] ?>&action=reduce" class="btn btn-dark">Kurangi</a>
                        <a href="checkout.php?book_id=<?= $cart['book_id'] ?>&action=add" class="btn btn-dark">Tambah</a>
                        <a href="checkout.php?book_id=<?= $cart['book_id'] ?>&action=delete" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php $total += $cart['quantity'] * $cart['harga']; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Total</th>
                <th>Rp. <?= htmlspecialchars(number_format($total, 0, ',', '.')) ?></th>
            </tr>
        </tfoot>
    </table>
    <form action="" method="post">
        <button type="submit" name="place_order" class="btn btn-primary">Tempatkan Pesanan</button>
    </form>
</div>

<?php include "../layouts/footer.php" ?>