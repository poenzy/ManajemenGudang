<?php
// verify_email.php

// Konfigurasi Database (Sama seperti di proses_regist.php)
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "manajemen_gudang";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Cari token di database
    $stmt = $conn->prepare("SELECT id_admin, token_expiry FROM user WHERE email_verification_token = ? AND email_verified = 0");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $token_expiry = strtotime($row['token_expiry']);

        // Cek apakah token belum kedaluwarsa
        if (time() < $token_expiry) {
            // Token valid, update status verifikasi email
            $update_stmt = $conn->prepare("UPDATE user SET email_verified = 1, email_verification_token = NULL, token_expiry = NULL WHERE id = ?");
            $update_stmt->bind_param("i", $user_id);

            if ($update_stmt->execute()) {
                echo '
                    <script>
                        alert("Email Anda berhasil diverifikasi! Anda sekarang bisa login.");
                        window.location.href = "login.php"; // Arahkan ke halaman login
                    </script>
                ';
            } else {
                echo "Error saat memperbarui status verifikasi: " . $update_stmt->error;
            }
            $update_stmt->close();
        } else {
            echo "Token verifikasi sudah kedaluwarsa. Silakan coba daftar lagi atau minta verifikasi ulang.";
            // Anda bisa tambahkan logika untuk mengirim ulang email verifikasi di sini
        }
    } else {
        echo "Token verifikasi tidak valid atau sudah digunakan.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Akses tidak sah. Token verifikasi tidak ditemukan.";
}
?>