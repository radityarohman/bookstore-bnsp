<?php
session_start();
include '../config/app.php';
include '../layouts/user_header.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$orders = select("SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id = u.id WHERE o.user_id = $user_id ORDER BY o.created_at DESC");

?>

<div class="container mt-3">
    <h1>Riwayat Pesanan</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Pesanan</th>
                <th scope="col">Username</th>
                <th scope="col">Status Pesanan</th>
                <th scope="col">Status Pembayaran</th>
                <th scope="col">Total</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($orders as $order) : ?>
                <?php
                // Ambil total harga pesanan
                $order_details = select("SELECT SUM(quantity * price) AS total FROM orders_detail WHERE order_id = {$order['id']}");
                $total = $order_details[0]['total'];
                ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= htmlspecialchars($order['created_at']) ?></td>
                    <td><?= htmlspecialchars($order['username']) ?></td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td>Rp. <?= htmlspecialchars(number_format($total, 0, ',', '.')) ?></td>
                    <td>
                        <a href="order_detail.php?order_id=<?= $order['id'] ?>" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../layouts/footer.php" ?>