<?php
// processes_regist.php

// Panggil file autoload Composer jika Anda menggunakan Composer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Konfigurasi Database (Ganti dengan detail database Anda)
$servername = "localhost";
$username_db = "root"; // Ganti dengan username database Anda
$password_db = "";     // Ganti dengan password database Anda
$dbname = "manajemen_gudang"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Proses form jika ada data yang dikirim
if (isset($_POST['input'])) { // 'input' adalah nama tombol submit Anda
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Password mentah dari form

    // --- Validasi Server-Side (PENTING!) ---
    if (empty($nama_lengkap) || empty($username) || empty($email) || empty($password)) {
        die("Semua kolom harus diisi.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Format email tidak valid.");
    }
    if (strlen($password) < 6) {
        die("Password minimal 6 karakter.");
    }

    // --- Hash Password (PENTING untuk keamanan!) ---
    $hashed_password = $password;

    // --- Generate Token Verifikasi Email ---
    $email_verification_token = bin2hex(random_bytes(32)); // Token unik
    $token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token berlaku 1 jam

    // --- Simpan Data ke Database ---
    // Pastikan Anda memiliki tabel 'users' dengan kolom:
    // id (INT PRIMARY KEY AUTO_INCREMENT)
    // nama_lengkap (VARCHAR)
    // username (VARCHAR UNIQUE)
    // email (VARCHAR UNIQUE)
    // password (VARCHAR)
    // email_verified (TINYINT DEFAULT 0)
    // email_verification_token (VARCHAR NULL)
    // token_expiry (DATETIME NULL)

    $stmt = $conn->prepare("INSERT INTO user (nama_lengkap, username, email, password, email_verification_token, token_expiry) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama_lengkap, $username, $email, $hashed_password, $email_verification_token, $token_expiry);

    if ($stmt->execute()) {
        // Data berhasil disimpan, sekarang kirim email verifikasi

        $mail = new PHPMailer(true); // Buat instance PHPMailer; 'true' enables exceptions

        try {
            // Konfigurasi Server SMTP (Ganti dengan detail SMTP Anda)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Contoh: 'smtp.gmail.com' atau 'smtp.mailgun.org'
            $mail->SMTPAuth   = true;
            $mail->Username   = 'zeph653@gmail.com'; // Ganti dengan email pengirim Anda
            $mail->Password   = 'dlio rtjm xvwc kliu';    // Ganti dengan password aplikasi/kata sandi khusus (bukan password akun biasa)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Atau PHPMailer::ENCRYPTION_SMTPS untuk port 465
            $mail->Port       = 587; // Port SMTP, biasanya 587 untuk STARTTLS, 465 untuk SMTPS

            // Pengaturan Pengirim dan Penerima
            $mail->setFrom($email, 'Manajemen Gudang'); // Ganti dengan email & nama pengirim
            $mail->addAddress($email, $nama_lengkap); // Tambahkan penerima (email pengguna yang mendaftar)

            // Konten Email
            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi Akun Anda di Aplikasi Saya';
            
            // Link verifikasi (Ganti domain.com dengan domain aplikasi Anda)
            $verification_link = "http://localhost/Manajemen_Gudang/verify_email.php?token=" . $email_verification_token;
            // Jika Anda sudah punya domain, gunakan: "https://aplikasianda.com/verify_email.php?token=" . $email_verification_token;

            $mail->Body    = "
                Halo " . $nama_lengkap . ",<br><br>
                Terima kasih telah mendaftar di aplikasi kami. <br>
                Untuk menyelesaikan pendaftaran, silakan verifikasi alamat email Anda dengan mengklik tautan di bawah ini:<br><br>
                <a href='" . $verification_link . "'>Verifikasi Email Saya</a><br><br>
                Jika Anda tidak mendaftar di aplikasi kami, Anda bisa mengabaikan email ini.<br><br>
                Hormat kami,<br>
                Tim Aplikasi Anda
            ";
            $mail->AltBody = "Halo " . $nama_lengkap . ",\n\nTerima kasih telah mendaftar di aplikasi kami. Untuk menyelesaikan pendaftaran, silakan verifikasi alamat email Anda dengan mengunjungi tautan ini: " . $verification_link . "\n\nJika Anda tidak mendaftar di aplikasi kami, Anda bisa mengabaikan email ini.\n\nHormat kami,\nTim Aplikasi Anda";

            $mail->send();
            echo '
                <script>
                    alert("Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi.");
                    window.location.href = "login.php"; // Arahkan ke halaman informasi
                </script>
            ';
        } catch (Exception $e) {
            echo "Pendaftaran berhasil, tetapi email verifikasi gagal dikirim. Mailer Error: {$mail->ErrorInfo}";
            // Anda bisa tambahkan logging error ke file atau database di sini
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika tidak ada data POST, mungkin pengguna langsung mengakses file ini
    echo "Akses tidak sah.";
}
?>