<?php
require '../koneksi.php';

$judul = $_GET['judul'];
$id = "MDG-" . mt_rand(1000, 99999);
$pengumuman = $_POST['pengumuman'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];
$kelas = $_POST['kelas'];

$query = "INSERT INTO mading VALUES('$id','$pengumuman','$deskripsi','$tanggal','$kelas')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=mading&judul=$judul'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=mading&judul=$judul'>";
}
