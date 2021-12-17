<?php
require '../koneksi.php';
$id = $_GET['id'];
$nominal = $_GET['nominal'];
$status = $_GET['status'];
$id_akun = $_GET['id_akun'];
$minggu = $_GET['minggu'];

if ($status == 2) {
    $query = "DELETE FROM transaksi WHERE id_transaksi='$id'";
    $result = mysqli_query($koneksi, $query);
    $query = "UPDATE akun SET saldo = saldo-'$nominal' WHERE id_akun = '$id_akun'";
    $result1 = mysqli_query($koneksi, $query);
    if ($result && $result1) {
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu'>";
    } else {
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu'>";
    }
} else {
    $query = "DELETE FROM transaksi WHERE id_transaksi='$id'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu'>";
    } else {
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu'>";
    }
}
