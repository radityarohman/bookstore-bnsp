<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include "../layouts/admin_header.php";
include "../config/app.php";

$order_id = (int)$_GET['order_id'];
$order = select("SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id = u.id WHERE o.id = $order_id")[0];
$order_details = select("SELECT od.*, b.judul FROM order_details od JOIN books b ON od.book_id = b.id WHERE od.order_id = $order_id");

?>

<div class="container mt-3">
    <h1>Detail Pesanan #<?= htmlspecialchars($order_id) ?></h1>
    <p>Username: <?= htmlspecialchars($order['username']) ?></p>
    <p>Status: <?= htmlspecialchars($order['status']) ?></p>
    <p>Tanggal: <?= htmlspecialchars($order['created_at']) ?></p>

    <table class="table table-striped">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
        </thead>
        <tbody>
            <?php $no = 1;
            $total = 0; ?>
            <?php foreach ($order_details as $detail) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= htmlspecialchars($detail['judul']) ?></td>
                    <td>Rp. <?= htmlspecialchars(number_format($detail['price'], 0, ',', '.')) ?></td>
                    <td><?= htmlspecialchars($detail['quantity']) ?></td>
                    <td>Rp. <?= htmlspecialchars(number_format($detail['quantity'] * $detail['price'], 0, ',', '.')) ?></td>
                </tr>
                <?php $total += $detail['quantity'] * $detail['price']; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Total</th>
                <th>Rp. <?= htmlspecialchars(number_format($total, 0, ',', '.')) ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<?php include "../layouts/footer.php" ?>