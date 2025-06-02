<?php

require_once 'Conn.php';
session_start();
if (isset($_POST['id'])) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $update = "UPDATE user SET jabatan=?, status=? WHERE id_admin=?";
    $updateStmt = $conn->prepare($update);
    $updateStmt->bind_param("ssi", $jabatan, $status, $id);

    try {
        if ($updateStmt->execute()) {
            $_SESSION['toast'] = 'Success data admin diubah';
            $conn->close();
            header('Location: ../user_management.php');
            exit;
        } else {
            $_SESSION['toast'] = 'Failed data admin gagal diubah';
            throw new Exception('GAGAL' . $conn->error);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}