<?php
require '../koneksi.php';
$judul = $_GET['judul'];
$id = $_GET['id'];

$query = "DELETE FROM barang WHERE id_barang='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=barang&judul=$judul'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=barang&judul=$judul'>";
}
