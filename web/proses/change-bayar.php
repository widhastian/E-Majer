<?php
require '../koneksi.php';

$judul = $_GET['judul'];
$id = $_GET['id'];
$nominal = $_GET['nominal'];
$id_kelas = $_GET['id_kelas'];
$minggu = $_GET['minggu'];

$query = "UPDATE transaksi SET status = 'sudah bayar' WHERE id_transaksi = '$id'";
$result = mysqli_query($koneksi, $query);
$query = "UPDATE saldo SET jumlah_saldo = jumlah_saldo+'$nominal' WHERE id_kelas = '$id_kelas'";
$result1 = mysqli_query($koneksi, $query);

if ($result && $result1) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu&judul=$judul'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu&judul=$judul'>";
}
