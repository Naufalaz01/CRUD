<?php
// include database connection file
include_once("koneksi.php");

// Fungsi untuk menghapus artikel
function deleteArtikel($artikelID)
{
    global $koneksi;

    // Lakukan query penghapusan berdasarkan artikel_id
    $deleteQuery = "DELETE FROM artikel WHERE artikel_id = $artikelID";

    if (mysqli_query($koneksi, $deleteQuery)) {
        return true; // Mengembalikan true jika penghapusan berhasil
    } else {
        return false; // Mengembalikan false jika terjadi kesalahan
    }
}

// Cek apakah parameter 'id' telah diberikan di URL
if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $deleteResult = deleteArtikel($userID);
    if ($deleteResult) {
        // Redirect ke halaman ini sendiri setelah penghapusan selesai
        header("Location: index.php");
        exit;
    }
}

// Query untuk mengambil data artikel dari database
$query = "SELECT artikel_id, user_id, judul, isi FROM artikel";

$result = mysqli_query($koneksi, $query);

// Cek apakah ada data artikel
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Artikel ID</th><th>User ID</th><th>Judul</th><th>Isi</th><th>Action</th></tr>";

    // Loop untuk menampilkan data artikel dalam tabel
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['artikel_id'] . "</td>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['judul'] . "</td>";
        echo "<td>" . $row['isi'] . "</td>";
        echo "<td><button onclick=\"location.href='edit.php?id=" . $row['artikel_id'] . "';\">Edit</button></td>";
        echo "<td><button onclick=\"location.href='index.php?id=" . $row['artikel_id'] . "';\">Delete</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data artikel.";
}
?>

<!-- Tombol untuk menavigasi ke halaman 'add.php' -->
<button onclick="location.href='add.php'">Add Artikel</button>