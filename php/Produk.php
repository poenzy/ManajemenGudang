<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'manajemen_gudang';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal" . $conn->connect_error);
}

function getAllBarang()
{
    global $conn;
    $query = "SELECT * FROM produk_barang";
    return $conn->query($query);
}