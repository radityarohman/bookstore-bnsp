<?php
session_start();
include '../config/app.php';
include '../layouts/user_header.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

$order_id = (int)$_GET['order_id'];
$order = select("SELECT * FROM orders WHERE id = $order_id")[0];

if (isset($_POST['confirm_payment'])) {
    $query = "UPDATE orders SET status = 'completed' WHERE id = $order_id";
    mysqli_query($db, $query);

    echo "<script>
        alert('Pembayaran berhasil');
        document.location.href = 'order_history.php';
    </script>";
}
?>

<div class="container mt-3">
    <h1>Konfirmasi Pembayaran</h1>
    <p>Pesanan ID: <?= htmlspecialchars($order_id) ?></p>
    <p>Status: <?= htmlspecialchars($order['status']) ?></p>
    <p>Tanggal Pesanan: <?= htmlspecialchars($order['created_at']) ?></p>
    <p>Status Pembayaran: <?= htmlspecialchars($order['status']) ?></p>

    <form action="" method="post">
        <button type="submit" name="confirm_payment" class="btn btn-primary">Konfirmasi Pembayaran</button>
    </form>
</div>

<?php include "../layouts/footer.php" ?>