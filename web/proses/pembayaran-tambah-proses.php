<?php
require '../koneksi.php';

$judul = $_GET['judul'];
$id = mt_rand(1000, 99999);
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$tanggal = $_POST['tanggal'];
$minggu = $_POST['minggu'];
$total = $_POST['total'];

$query = "INSERT INTO transaksi VALUES('$id','$nama','$kelas','$tanggal','$total','veirifikasi','-')";
$result = mysqli_query($koneksi, $query);
$query1 = "INSERT INTO transaksi_detail VALUES('','$id','$minggu')";
$result1 = mysqli_query($koneksi, $query1);

if ($result && $result1) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu&judul=$judul'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu&judul=$judul'>";
}
