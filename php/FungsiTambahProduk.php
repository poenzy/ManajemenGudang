<?php
function tambahProduk($data)
{
    global $conn;
    session_start(); // Tambahkan ini untuk memastikan session aktif

    // Mengambil data dari form
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
    $foto = mysqli_real_escape_string($conn, $_FILES['foto']['name']);

    // Simpan file yang diupload
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto);

    // Query insert
    $query = "INSERT INTO produk_barang (kode_produk, nama_produk, deskripsi, kategori, merek, jumlah_stok, satuan, lokasi_gudang, harga_beli, harga_jual, tanggal_masuk, tanggal_kedaluwarsa, status_produk, foto_produk) 
            VALUES ('$kode', '$nama', '$deskripsi', '$kategori', '$merek', $stok, '$satuan', '$lokasi', $hargaBeli, $hargaJual, '$tanggalMasuk', '$tanggalKedaluwarsa', '$statusProduk', '$foto')";

    if ($conn->query($query) === TRUE) {
        $_SESSION['toast'] = '✅ Produk berhasil ditambahkan!';
    } else {
        $_SESSION['toast'] = '❌ Gagal menambahkan produk.';
    }

    header("Location: tambahProduk.php");
    exit;
}