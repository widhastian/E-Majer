<?php
require '../koneksi.php';

$minggu = $_POST['minggu'];
$tanggal = $_POST['tanggal'];
$kelas = $_POST['kelas'];

$query = "INSERT INTO minggu VALUES('','$minggu','$tanggal','$kelas')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=buku-transaksi'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=buku-transaksi'>";
}
