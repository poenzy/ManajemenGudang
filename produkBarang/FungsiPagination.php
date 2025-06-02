<?php

// session_start();
require_once 'Produk.php';

function getBarangLimit()
{
    global $conn;

    $filter = '';
    if (isset($_GET['cari']) && !empty($_GET['cari'])) {
        $cari = htmlspecialchars($_GET['cari']);
        $cari = trim($cari);
        $cari = mysqli_real_escape_string($conn, $cari);
        $filter = "WHERE nama_produk LIKE '%$cari%'";
    }

    $dataPerHalaman = 4;
    $totalData = $conn->query("SELECT COUNT(*) AS total FROM produk_barang $filter")->fetch_assoc();
    $totalBaris = $totalData['total'];
    $totalHalaman = ceil($totalBaris / $dataPerHalaman);
    $halamanSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($halamanSekarang - 1) * $dataPerHalaman;

    $_SESSION['totalHalaman'] = $totalHalaman;
    $_SESSION['halamanSekarang'] = $halamanSekarang;
    $query = "SELECT * FROM produk_barang $filter ORDER BY id_produk ASC LIMIT $dataPerHalaman OFFSET $offset ";
    return $conn->query($query);
}

function getStokBarang()
{
    global $conn;

    $cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
    $dataPerHalaman = 4;
    // Hitung total baris untuk pagination
    $countSql = "SELECT COUNT(*) AS total 
                    FROM produk_barang p
                    LEFT JOIN (
                        SELECT id_produk, MAX(tanggal_transaksi) AS latest
                        FROM transaksi
                        WHERE tanggal_transaksi >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                        GROUP BY id_produk
                        ) t2 ON p.id_produk = t2.id_produk
                        WHERE p.nama_produk LIKE CONCAT('%', ? ,'%')";
    $countStmt = $conn->prepare($countSql);
    $countStmt->bind_param("s", $cari);
    $countStmt->execute();
    $result = $countStmt->get_result();
    $row = $result->fetch_assoc();
    $totalBaris = $row['total'];

    $totalHalaman = ceil($totalBaris / $dataPerHalaman);
    $halamanSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($halamanSekarang - 1) * $dataPerHalaman;

    $_SESSION['totalHalaman'] = $totalHalaman;
    $_SESSION['halamanSekarang'] = $halamanSekarang;

    // Ambil data stok + transaksi
    $sql = "SELECT p.id_produk,
        p.kode_produk, 
        p.foto_produk,
        p.nama_produk, 
        p.satuan, 
        t.jumlah, 
        t.tanggal_transaksi, 
        t.keterangan
        FROM produk_barang p
        LEFT JOIN(
            SELECT t1.*
            FROM transaksi t1
            JOIN (
                SELECT id_produk, MAX(tanggal_transaksi) AS latest
                FROM transaksi
                WHERE tanggal_transaksi >= DATE_SUB(CURDATE(), INTERVAL 30 Day)
                GROUP BY id_produk
            ) t2 ON t1.id_produk = t2.id_produk
                AND t1.tanggal_transaksi = t2.latest
        ) t ON p.id_produk = t.id_produk
        WHERE p.nama_produk LIKE CONCAT('%',?,'%')
        LIMIT ? OFFSET ?
    ";

    $sqlStmt = $conn->prepare($sql);
    $sqlStmt->bind_param("sii", $cari, $dataPerHalaman, $offset);
    $sqlStmt->execute();
    $sqlResult = $sqlStmt->get_result();
    return $sqlResult;
}