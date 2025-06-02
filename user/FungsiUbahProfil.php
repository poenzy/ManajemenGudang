<?php
require_once 'Conn.php';
session_start();

if (isset($_POST['id_admin'])) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $_POST['id_admin']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email_user']);
    $noTel = mysqli_real_escape_string($conn, $_POST['no_telepon']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    // periksa apakah foto sudah tersedia
    $query = "SELECT * FROM user WHERE id_admin=$id";
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);
    $fotoLama = $row['foto_profil'];

    if (!empty($_FILES['foto_profil']['name'])) {
        $foto = mysqli_real_escape_string($conn, $_FILES['foto_profil']['name']);
        move_uploaded_file($_FILES['foto_profil']['tmp_name'], "C:/xampp/htdocs/Manajemen_Gudang/img/profil/$foto");
    } else {
        $foto = $fotoLama;
    }

    $query = "UPDATE user SET
    nama_lengkap='$nama',
    email='$email',
    no_telepon='$noTel',
    alamat ='$alamat',
    foto_profil ='$foto' WHERE id_admin=$id";

    if ($conn->query($query) == true) {
        $_SESSION['toast'] = 'success data user berhasil diubah!';
    } else {
        $_SESSION['toast'] = 'failed data user gagal diubah';
    }
    $conn->close();
    header('Location: ../profilPengguna.php');
    exit;
}