<?php
// Pastikan koneksi ke database sudah dilakukan sebelumnya
include 'Produk.php'; // Sesuaikan dengan nama file koneksi
session_start(); // Mulai sesi untuk menyimpan pesan toast

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $keterangan = $_POST['keterangan']; // 'masuk' atau 'keluar'
    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Query untuk mendapatkan stok saat ini
        $query_stok = "SELECT jumlah_stok FROM produk_barang WHERE id_produk = ?";
        $stmt = $conn->prepare($query_stok);
        $stmt->bind_param("i", $id_produk);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Ambil jumlah stok saat ini
            $row = $result->fetch_assoc();
            $stok_lama = $row['jumlah_stok'];

            if ($keterangan == 'masuk') {
                // Jika produk masuk, update stok dengan menambah jumlah
                $stok_baru = $stok_lama + $jumlah;
                $query_update = "UPDATE produk_barang SET jumlah_stok = ? WHERE id_produk = ?";
                $stmt_update = $conn->prepare($query_update);
                $stmt_update->bind_param("ii", $stok_baru, $id_produk);
                $stmt_update->execute();

                if ($stmt_update->affected_rows === 0) {
                    throw new Exception("Gagal memperbarui stok produk.");
                }
            } elseif ($keterangan == 'keluar') {
                // Jika produk keluar, update stok dengan mengurangi jumlah
                if ($stok_lama >= $jumlah) {
                    $stok_baru = $stok_lama - $jumlah;
                    $query_update = "UPDATE produk_barang SET jumlah_stok = ? WHERE id_produk = ?";
                    $stmt_update = $conn->prepare($query_update);
                    $stmt_update->bind_param("ii", $stok_baru, $id_produk);
                    $stmt_update->execute();

                    if ($stmt_update->affected_rows === 0) {
                        throw new Exception("Gagal memperbarui stok produk.");
                    }
                } else {
                    throw new Exception("Stok tidak mencukupi untuk transaksi keluar.");
                }
            }
        } else {
            throw new Exception("Produk tidak ditemukan.");
        }

        // Catat transaksi di tabel transaksi
        $query_transaksi = "INSERT INTO transaksi (id_produk, jumlah, tanggal_transaksi, keterangan) 
                            VALUES (?, ?, ?, ?)";
        $stmt_transaksi = $conn->prepare($query_transaksi);
        $stmt_transaksi->bind_param("iiss", $id_produk, $jumlah, $tanggal_transaksi, $keterangan);
        $stmt_transaksi->execute();

        if ($stmt_transaksi->affected_rows === 0) {
            throw new Exception("Gagal mencatat transaksi.");
        }

        // Commit transaksi jika tidak ada error
        $conn->commit();

        // Set toast message
        $_SESSION['toast'] = 'Success Transaksi berhasil disimpan!';
    } catch (Exception $e) {
        // Jika terjadi error, rollback transaksi
        $conn->rollback();

        // Set toast message for error
        $_SESSION['toast'] = 'Failed ' . $e->getMessage();
    } finally {
        // Tutup statement dan koneksi
        $stmt->close();
        if (isset($stmt_update)) $stmt_update->close();
        if (isset($stmt_transaksi)) $stmt_transaksi->close();
        $conn->close();
    }

    // Redirect atau lanjutkan sesuai kebutuhan
    header('Location: ../aturStok.php'); // Sesuaikan dengan halaman yang sesuai
    exit;
}