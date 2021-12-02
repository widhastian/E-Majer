<?php
require '../koneksi.php';
$id = $_GET['id'];

$query = "DELETE FROM barang WHERE id_barang='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=barang'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=barang'>";
}
