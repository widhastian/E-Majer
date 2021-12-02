<?php
require '../koneksi.php';

$id = "TR-" . mt_rand(1000, 99999);
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$tanggal = $_POST['tanggal'];
$nominal = $_POST['nominal'];

$query = "INSERT INTO transaksi VALUES('$id','$nama','$kelas','$tanggal','$nominal',1)";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran'>";
}
