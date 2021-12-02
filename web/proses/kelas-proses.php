<?php
require '../koneksi.php';

$id_kelas = $_POST['id_kelas'];
$nama_kelas = $_POST['nama_kelas'];
$nominal = $_POST['nominal'];

$query = "UPDATE kelas SET nama_kelas = '$nama_kelas', nominal_uangkas = '$nominal' WHERE id_kelas = '$id_kelas'";
$result = mysqli_query($koneksi, $query);
if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=home'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=home'>";
}
