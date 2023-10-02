<?php
include('koneksi.php');

// Inisialisasi variable pesan kesalahan
$error_message = "";

// Memeriksa Apakah Formulir telah di kirimkan
if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    // Memeriksa Apakah Ada Kolom Yang kosong
    if (empty($user_id) || empty($judul) || empty($isi)) {
        $error_message = "Data Tidak Boleh Kosong!!";
    } else {
        // Menambkan Data Ke Dalam Tabel Artikel
        $insert_query = "INSERT INTO artikel(user_id, judul, isi) VALUES ('$user_id', '$judul', '$isi')";

        if (mysqli_query($koneksi, $insert_query)) {
            echo "User Berhasil Di Tambahkan ";
        } else {
            echo "ERROR: " . mysqli_error($koneksi);
        }
    }
}

?>
<html>

<head>
    <title>Add User</title>
</head>

<body>
    <button><a href="index.php">Go To Home</a></button>

    <br> <br>
    <?php

    // Menampilkan Pesan Kesalahan
    if (!empty($error_message)) {
        echo "<p style='color: red;'> $error_message </P>";
    }
    ?>

    <form action="add.php" method="post" name="form1">
        <table>
            <tr>
                <td>user_id</td>
                <td><input type="text" name="user_id"></td>
            </tr>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul"></td>
            </tr>
            <tr>
                <td>Isi</td>
                <td><input type="text" name="isi"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="add"></td>
            </tr>
        </table>
    </form>
</body>

</html>