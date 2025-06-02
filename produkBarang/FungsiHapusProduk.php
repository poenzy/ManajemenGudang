<?php
session_start();
require_once 'Produk.php';

function hapusData($data)
{
    global $conn;
    $id = $data['id'];
    $query = "DELETE FROM produk_barang WHERE id_produk=$id";

    if ($conn->query($query) == true) {
        $_SESSION['toast'] = 'success Produk berhasil dihapus';
    } else {
        $_SESSION['toast'] = 'failed Gagal menghapus produk';
    }

    header('Location: ../produk.php');
    $conn->close();
    exit;
}

hapusData($_POST);