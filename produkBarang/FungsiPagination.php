<?php

// session_start();
require_once 'Produk.php';

function getBarangLimit()
{
    global $conn;

    $filters = [];
    $whereClauses = [];
    if (isset($_GET['cari']) && !empty($_GET['cari'])) {
        $cari = htmlspecialchars($_GET['cari']);
        $cari = trim($cari);
        $cari = mysqli_real_escape_string($conn, $cari);
        $whereClauses[] = " nama_produk LIKE '%$cari%'";
    }

    if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
        $kategori = htmlspecialchars($_GET['kategori']);
        $kategori = trim($kategori);
        $kategori = mysqli_real_escape_string($conn, $kategori);
        $whereClauses[] = " kategori = '$kategori'";
    }

    if (!empty($whereClauses)) {
        $filters = "WHERE " . implode(" AND ", $whereClauses);
    } else {
        $filters = "";
    }

    $dataPerHalaman = 4;
    $totalData = $conn->query("SELECT COUNT(*) AS total FROM produk_barang $filters")->fetch_assoc();
    $totalBaris = $totalData['total'];
    $totalHalaman = ceil($totalBaris / $dataPerHalaman);
    $halamanSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($halamanSekarang - 1) * $dataPerHalaman;

    $_SESSION['totalHalaman'] = $totalHalaman;
    $_SESSION['halamanSekarang'] = $halamanSekarang;
    $query = "SELECT * FROM produk_barang $filters ORDER BY id_produk ASC LIMIT $dataPerHalaman OFFSET $offset ";
    return $conn->query($query);
}

function getStokBarang()
{
    global $conn;

    $dataPerHalaman = 4;
    $cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
    $kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

    // =============================
    // Siapkan klausa WHERE dinamis
    // =============================
    $whereClauses = [];
    $params = [];
    $types = '';

    if (!empty($cari)) {
        $whereClauses[] = "p.nama_produk LIKE ?";
        $params[] = '%' . $cari . '%';
        $types .= 's';
    }

    if (!empty($kategori) && $kategori !== 'semua') {
        $whereClauses[] = "p.kategori = ?";
        $params[] = $kategori;
        $types .= 's';
    }

    $whereSQL = '';
    if (!empty($whereClauses)) {
        $whereSQL = "WHERE " . implode(" AND ", $whereClauses);
    }

    // =============================
    // Hitung total data untuk pagination
    // =============================
    $countSql = "SELECT COUNT(*) AS total 
                 FROM produk_barang p
                 LEFT JOIN (
                     SELECT id_produk, MAX(tanggal_transaksi) AS latest
                     FROM transaksi
                     WHERE tanggal_transaksi >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                     GROUP BY id_produk
                 ) t2 ON p.id_produk = t2.id_produk
                 $whereSQL";

    $countStmt = $conn->prepare($countSql);
    if (!empty($params)) {
        $countStmt->bind_param($types, ...$params);
    }
    $countStmt->execute();
    $result = $countStmt->get_result();
    $row = $result->fetch_assoc();
    $totalBaris = $row['total'];

    $totalHalaman = ceil($totalBaris / $dataPerHalaman);
    $halamanSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($halamanSekarang - 1) * $dataPerHalaman;

    $_SESSION['totalHalaman'] = $totalHalaman;
    $_SESSION['halamanSekarang'] = $halamanSekarang;

    // =============================
    // Ambil data stok + transaksi terakhir
    // =============================
    $sql = "SELECT p.id_produk,
                   p.kode_produk, 
                   p.foto_produk,
                   p.nama_produk, 
                   p.kategori,
                   p.satuan, 
                   t.jumlah, 
                   t.tanggal_transaksi, 
                   t.keterangan
            FROM produk_barang p
            LEFT JOIN (
                SELECT t1.*
                FROM transaksi t1
                JOIN (
                    SELECT id_produk, MAX(tanggal_transaksi) AS latest
                    FROM transaksi
                    WHERE tanggal_transaksi >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                    GROUP BY id_produk
                ) t2 ON t1.id_produk = t2.id_produk
                    AND t1.tanggal_transaksi = t2.latest
            ) t ON p.id_produk = t.id_produk
            $whereSQL
            ORDER BY p.id_produk ASC
            LIMIT ? OFFSET ?";

    // Tambahkan tipe dan nilai limit + offset
    $types .= 'ii';
    $params[] = $dataPerHalaman;
    $params[] = $offset;

    $sqlStmt = $conn->prepare($sql);
    $sqlStmt->bind_param($types, ...$params);
    $sqlStmt->execute();

    return $sqlStmt->get_result();
}