<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'manajemen_gudang';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Koneksi ke database error =' . $conn->connect_error);
}

function getAllDataProduk()
{
    global $conn;
    $query = "SELECT kategori,SUM(jumlah_stok) as jumlah
                FROM produk_barang
                GROUP BY kategori";
    $queryStmt = $conn->prepare($query);
    $queryStmt->execute();
    $result = $queryStmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function produkMasuk()
{
    global $conn;
    $sql = "SELECT p.kategori, SUM(t.jumlah) as jumlah ,t.tanggal_transaksi 
            FROM produk_barang p
            JOIN transaksi t ON p.id_produk = t.id_produk
            WHERE t.tanggal_transaksi >= DATE_SUB(CURDATE(),INTERVAL 30 DAY) and t.keterangan ='masuk'
            GROUP BY p.kategori";

    $sqlStmt = $conn->prepare($sql);
    $sqlStmt->execute();
    $result = $sqlStmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function produkKeluar()
{
    global $conn;
    $sql = "SELECT p.kategori, SUM(t.jumlah) as jumlah ,t.tanggal_transaksi 
            FROM produk_barang p
            JOIN transaksi t ON p.id_produk = t.id_produk
            WHERE t.tanggal_transaksi >= DATE_SUB(CURDATE(),INTERVAL 30 DAY) and t.keterangan ='keluar'
            GROUP BY p.kategori";

    $sqlStmt = $conn->prepare($sql);
    $sqlStmt->execute();
    $result = $sqlStmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}