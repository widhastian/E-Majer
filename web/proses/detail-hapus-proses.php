<?php
require '../koneksi.php';
$id = $_GET['id'];
$transaksi = $_GET['transaksi'];

$query = "DELETE FROM detail_transaksi WHERE id_detail='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=detail&id=$transaksi'>";
}
