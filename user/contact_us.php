<?php
session_start();
include '../config/app.php';
include '../layouts/user_header.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

// Variabel untuk menyimpan pesan error dan sukses
$error = $success = '';

if (isset($_POST['send_message'])) {
    $user_id = $_SESSION['user_id'];
    $message = mysqli_real_escape_string($db, $_POST['message']);

    if (empty($message)) {
        $error = 'Subjek dan pesan tidak boleh kosong.';
    } else {
        $query = "INSERT INTO messages (user_id, message) VALUES ($user_id, '$message')";
        if (mysqli_query($db, $query)) {
            $success = 'Pesan Anda telah berhasil dikirim!';
        } else {
            $error = 'Gagal mengirim pesan: ' . mysqli_error($db);
        }
    }
}
?>

<div class="container mt-3">
    <h1>Hubungi Kami</h1>

    <?php if ($success) : ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" name="send_message" class="btn btn-primary">Kirim Pesan</button>
    </form>
</div>

<?php include "../layouts/footer.php" ?>