<?php
require '../koneksi.php';
$id = $_GET['id'];
$nominal = $_GET['nominal'];
$status = $_GET['status'];
$id_kelas = $_GET['id_kelas'];
$minggu = $_GET['minggu'];

if ($status === "sudah bayar") {
    $query = "DELETE FROM transaksi WHERE id_transaksi='$id'";
    $result = mysqli_query($koneksi, $query);
    $query = "DELETE FROM transaksi_detail WHERE id_transaksi='$id'";
    $result1 = mysqli_query($koneksi, $query);
    $query = "UPDATE saldo SET jumlah_saldo = jumlah_saldo -'$nominal' WHERE id_kelas = '$id_kelas'";
    $result2 = mysqli_query($koneksi, $query);
    if ($result && $result1 && $result2) {
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu'>";
    } else {
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu'>";
    }
} else {
    $query = "DELETE FROM transaksi WHERE id_transaksi='$id'";
    $result = mysqli_query($koneksi, $query);
    $query = "DELETE FROM transaksi_detail WHERE id_transaksi='$id'";
    $result1 = mysqli_query($koneksi, $query);
    if ($result && $result1) {
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu'>";
    } else {
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&minggu=$minggu'>";
    }
}
