<?php
// Cek jika ada pesan sukses atau kesalahan di URL
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_GET['success']) . '</div>';
}
if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_GET['error']) . '</div>';
}
?>
