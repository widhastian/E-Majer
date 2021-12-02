<?php
require '../koneksi.php';
$id = $_GET['id'];

$query = "DELETE FROM pengeluaran WHERE id_pengeluaran='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pengeluaran'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pengeluaran'>";
}
