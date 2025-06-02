<?php
session_start();
require_once 'Produk.php';

function getProdukById($data)
{
    global $conn;

    $idProduk = htmlspecialchars($data['id']);
    if ($conn->connect_error) {
        die("Koneksi ke database gagal!");
    }
    $query = "SELECT  * FROM produk_barang WHERE id_produk = $idProduk";
    $result = $conn->query($query);
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }


    $conn->close();
    return $data;
}

$dataProduk = getProdukById($_POST);
$_SESSION['data_produk'] = $dataProduk;

header("Location: ../ubahProduk.php");
