<?php
require '../koneksi.php';

$judul = $_GET['judul'];
$id = $_POST['id'];
$barang = $_POST['barang'];
$transaksi = $_POST['transaksi'];
$jumlah = $_POST['jumlah'];

$query = "UPDATE detail_pengeluaran SET id_barang = '$barang', id_pengeluaran = '$transaksi', jumlah = '$jumlah' WHERE id_detail = '$id'";
$result = mysqli_query($koneksi, $query);
if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi&judul=$judul'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi&judul=$judul'>";
}
