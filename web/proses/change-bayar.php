<?php
require '../koneksi.php';

$id = $_GET['id'];
$nominal = $_GET['nominal'];
$id_akun = $_GET['id_akun'];
$tanggal = $_GET['tanggal'];

$query = "UPDATE transaksi SET status = '2' WHERE id_transaksi = '$id'";
$result = mysqli_query($koneksi, $query);
$query = "UPDATE akun SET saldo = saldo+'$nominal' WHERE id_akun = '$id_akun'";
$result1 = mysqli_query($koneksi, $query);
if ($result && $result1) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&tanggal=$tanggal'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&tanggal=$tanggal'>";
}
