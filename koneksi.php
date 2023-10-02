<?php

$host = "localhost";

$username = "root";

$pw = "";

$database = "naufal";

$koneksi = mysqli_connect($host, $username, $pw, $database);

if (!$koneksi) {
    die('kesalahan koneksi :' . mysqli_connect_error());
}

// echo "Koneksi Berhasil";
// mysqli_close($koneksi);
