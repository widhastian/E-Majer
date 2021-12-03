<?php
require 'koneksi.php';
session_start();
$id = "K-" . mt_rand(1000, 99999);
$kelas = $_POST['kelas'];
$nominal = $_POST['nominal'];

$query = "INSERT INTO kelas VALUES('$id','$kelas','$nominal')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $_SESSION['kelas'] = $id;
    echo "<meta http-equiv='refresh' content='0; url=berhasil-buat-kelas.php'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=berhasil-buat-kelas.php'>";
}
