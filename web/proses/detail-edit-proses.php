<?php
require '../koneksi.php';

$id = $_POST['id'];
$barang = $_POST['barang'];
$transaksi = $_POST['transaksi'];
$jumlah = $_POST['jumlah'];

$query = "UPDATE detail_transaksi SET id_barang = '$barang', id_pengeluaran = '$transaksi', jumlah = '$jumlah' WHERE id_detail = '$id'";
$result = mysqli_query($koneksi, $query);
if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi'>";
}
