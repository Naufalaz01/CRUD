<?php
// include database connection file
include_once("koneksi.php");

// Inisialisasi variable pesan kesalahan
$error_message = "";
$success_message = "";
$edit_mode = false; // Mode edit diatur ke false secara default

// Cek apakah parameter 'id' telah diberikan di URL
if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $edit_mode = true; // Aktifkan mode edit

    // Query untuk mengambil data artikel dari database berdasarkan 'id'
    $result = mysqli_query($koneksi, "SELECT * FROM artikel WHERE artikel_id=$userID");

    if ($result && mysqli_num_rows($result) > 0) {
        $artikel_data = mysqli_fetch_array($result);
        $user_id = $artikel_data['user_id'];
        $judul = $artikel_data['judul'];
        $isi = $artikel_data['isi'];
    } else {
        // Menangani kasus di mana tidak ada data yang ditemukan untuk 'id' yang diberikan
        echo "Data not found for Artikel ID: $userID";
        exit;
    }
}

// Memeriksa Apakah Formulir Telah Di Kirimkan
if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    if ($edit_mode) {
        // Mode edit: perbarui data artikel
        $update_query = "UPDATE artikel SET user_id='$user_id', judul='$judul', isi='$isi' WHERE artikel_id=$userID";

        if (mysqli_query($koneksi, $update_query)) {
            $success_message = "Artikel berhasil diperbarui";
        } else {
            $error_message = "Error: " . mysqli_error($koneksi);
        }
    } else {
        // Mode tambah: tambahkan data artikel baru
        $insert_query = "INSERT INTO artikel (user_id, judul, isi) VALUES ('$user_id', '$judul', '$isi')";

        if (mysqli_query($koneksi, $insert_query)) {
            $success_message = "Artikel berhasil ditambahkan";
        } else {
            $error_message = "Error: " . mysqli_error($koneksi);
        }
    }
}
?>

<html>

<head>
    <title><?php echo $edit_mode ? "Edit Artikel" : "Tambah Artikel"; ?></title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <?php
    // Menampilkan pesan kesalahan
    if (!empty($error_message)) {
        echo "<p style='color: red;'> $error_message </p>";
    }

    // Menampilkan pesan sukses
    if (!empty($success_message)) {
        echo "<p style='color: green;'> $success_message </p>";
    }
    ?>

    <form name="artikel_form" method="post" action="<?php echo $edit_mode ? "edit.php?id=$userID" : "add.php"; ?>">
        <table border="0">
            <tr>
                <td>User ID</td>
                <td><input type="text" name="user_id" value="<?php echo $edit_mode ? $user_id : ''; ?>"></td>
            </tr>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" value="<?php echo $edit_mode ? $judul : ''; ?>"></td>
            </tr>
            <tr>
                <td>Isi</td>
                <td><input type="text" name="isi" value="<?php echo $edit_mode ? $isi : ''; ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="<?php echo $edit_mode ? "Update" : "Tambah"; ?>"></td>
            </tr>
        </table>
    </form>
</body>

</html>