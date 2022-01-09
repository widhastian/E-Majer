<?php
require '../koneksi.php';

$judul = $_GET['judul'];
$id = $_GET['id'];
$transaksi = $_GET['transaksi'];

$query = "DELETE FROM detail_pengeluaran WHERE id_detail='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi&judul=$judul'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi&judul=$judul'>";
}
