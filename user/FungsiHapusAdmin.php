<?php
require_once 'Conn.php';
session_start();
if (isset($_POST['id'])) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $delete = "DELETE FROM user WHERE id_admin=?";
    $deleteStmt = $conn->prepare($delete);
    $deleteStmt->bind_param("i", $id);

    try {
        if ($deleteStmt->execute()) {
            $_SESSION['toast'] = 'Success data admin dihapus';
            $conn->close();
            header('Location: ../user_management.php');
            exit;
        } else {
            $_SESSION['toast'] = 'Failed data admin gagal dihapus';
            throw new Exception('GAGAL' . $conn->error);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}