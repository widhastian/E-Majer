<?php
require '../koneksi.php';

$nominal = $_POST['nominal'];
$keterangan = $_POST['keterangan'];
$tanggal = $_POST['tanggal'];
$kelas = $_POST['kelas'];

$query = "INSERT INTO minggu VALUES('','$nominal','$keterangan','$tanggal','$kelas')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=buku-transaksi'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=buku-transaksi'>";
}
