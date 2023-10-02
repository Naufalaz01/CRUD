<?php
// include database connection file
include_once("koneksi.php");

// Cek apakah parameter 'id' telah diberikan di URL
if (isset($_GET['id'])) {
    $userID = $_GET['id'];

    // Query untuk menghapus pengguna berdasarkan ID
    $deleteQuery = "DELETE FROM users WHERE id = $userID";

    // Eksekusi query penghapusan
    if (mysqli_query($koneksi, $deleteQuery)) {
        // Jika penghapusan berhasil, alihkan kembali ke halaman utama (misalnya, index.php)
        header("Location: index.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat menghapus, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Jika parameter 'id' tidak diberikan, tampilkan pesan kesalahan
    echo "ID pengguna tidak ditemukan.";
}
