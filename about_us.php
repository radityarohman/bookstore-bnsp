<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include 'layouts/user_header.php';

?>

<section class="py-3 py-md-5">
    <div class="container">
        <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
            <div class="col-12 col-lg-6 col-xl-5">
                <img class="img-fluid rounded" loading="lazy" src="assets/img/booklab.png" alt="booklab">
            </div>
            <div class="col-12 col-lg-6 col-xl-7">
                <div class="row justify-content-xl-center">
                    <div class="col-12 col-xl-11">
                        <h2 class="mb-3">Tentang BookLab</h2>
                        <p class="lead fs-4 text-secondary mb-3">Temukan buku favorit Anda dan nikmati pengalaman membaca yang luar biasa bersama kami. Terima kasih telah memilih BookLab!</p>
                        <p class="mb-5">BookLab adalah tempat ideal untuk menemukan buku-buku berkualitas dari berbagai genre. Kami berkomitmen untuk memberikan pengalaman membaca yang memuaskan dengan koleksi yang beragam dan staf yang siap membantu Anda</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 d-flex flex-column justify-content-center align-items-center">
            <h2>Review BookLab</h2>
            <p class="lead fs-4 text-secondary mb-3">Ini adalah video dari salah satu youtuber tentang BookLab</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/rHR6hcGoR8Q?si=QzVyROYSZOZa8QH5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>
</section>
<?php include 'layouts/footer.php' ?>