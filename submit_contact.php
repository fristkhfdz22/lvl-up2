<?php
header('Content-Type: application/json');

// Mulai sesi dan sambungkan ke database
session_start();
include 'db.php';

// Inisialisasi array untuk respons
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validasi input (misalnya, pastikan email valid)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Siapkan statement SQL untuk menyimpan data
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Eksekusi statement dan cek jika berhasil
        if ($stmt->execute()) {
            $response['success'] = "Pesan Anda telah dikirim!";
        } else {
            $response['error'] = "Terjadi kesalahan saat mengirim pesan: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $response['error'] = "Alamat email tidak valid.";
    }
}

// Tutup koneksi database
$conn->close();

// Kembalikan respons JSON
echo json_encode($response);
?>
