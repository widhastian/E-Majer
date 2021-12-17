<?php
require '../koneksi.php';
$id = $_GET['id'];

$query = "DELETE FROM minggu WHERE id_minggu='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=buku-transaksi'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=buku-transaksi'>";
}
