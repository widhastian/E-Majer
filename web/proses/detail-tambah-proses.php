<?php
require '../koneksi.php';

$id = "DT-" . mt_rand(1000, 99999);
$barang = $_POST['barang'];
$transaksi = $_POST['transaksi'];
$jumlah = $_POST['jumlah'];

$query = "INSERT INTO detail_transaksi VALUES('$id','$barang','$transaksi','$jumlah')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi'>";
}
