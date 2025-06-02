<?php
require 'Conn.php';

function getOneUser($user)
{
    global $conn;
    $username = $user;
    $query = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($query);

    try {
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
            $conn->close();
        } else {
            throw new Exception('Gagal mengambil data user :' . $conn->error);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getOneUserById($id)
{
    global $conn;
    $query = "SELECT * FROM user WHERE id_admin=$id";
    $result = $conn->query($query);

    try {
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
            $conn->close();
        } else {
            throw new Exception('Gagal mengambil data user :' . $conn->error);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}