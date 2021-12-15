<?php
require '../koneksi.php';
$id = $_GET['id'];

$query = "DELETE FROM mading WHERE id_mading='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&tanggal=$tanggal'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pembayaran&tanggal=$tanggal'>";
}
