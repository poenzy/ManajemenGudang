<?php

session_start();
require_once "Produk.php";

function ubahProduk($data)
{
    global $conn;

    $id = mysqli_real_escape_string($conn, $data['id_produk']);
    $kode = mysqli_real_escape_string($conn, $data['kode_produk']);
    $nama = mysqli_real_escape_string($conn, $data['nama_produk']);
    $deskripsi = mysqli_real_escape_string($conn, $data['deskripsi']);
    $kategori = mysqli_real_escape_string($conn, $data['kategori']);
    $merek = mysqli_real_escape_string($conn, $data['merek']);
    $stok = (int) $data['jumlah_stok'];
    $satuan = mysqli_real_escape_string($conn, $data['satuan']);
    $lokasi = mysqli_real_escape_string($conn, $data['lokasi_gudang']);
    $hargaBeli = (float) $data['harga_beli'];
    $hargaJual = (float) $data['harga_jual'];
    $tanggalMasuk = mysqli_real_escape_string($conn, $data['tanggal_masuk']);
    $tanggalKedaluwarsa = mysqli_real_escape_string($conn, $data['kedaluwarsa']);
    $statusProduk = mysqli_real_escape_string($conn, $data['status_produk']);

    // Mengambil foto
    $query = "SELECT * FROM produk_barang WHERE id_produk = $id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $fotoLama = $row['foto_produk'];

    if (!empty($_FILES['foto']['name'])) {
        $foto = mysqli_real_escape_string($conn, $_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], "C:/xampp/htdocs/Manajemen_Gudang/img/$foto");
    } else {
        $foto = $fotoLama;
    }

    $query = "UPDATE produk_barang SET 
    kode_produk = '$kode', 
    nama_produk = '$nama',
    deskripsi = '$deskripsi', 
    kategori = '$kategori', 
    merek = '$merek', 
    jumlah_stok = $stok, 
    satuan = '$satuan',
    lokasi_gudang = '$lokasi', 
    harga_beli = $hargaBeli, 
    harga_jual = $hargaJual,
    tanggal_masuk = '$tanggalMasuk',
    tanggal_kedaluwarsa = '$tanggalKedaluwarsa',
    status_produk = '$statusProduk',
    foto_produk = '$foto' 
WHERE id_produk = $id";

    if ($conn->query($query) === TRUE) {
        $_SESSION['toast'] = 'success Produk berhasil diubah!';
    } else {
        $_SESSION['toast'] = 'failed Gagal mengubah produk.';
    }

    header("Location:../produk.php");
    $conn->close();
    exit;
}

ubahProduk($_POST);