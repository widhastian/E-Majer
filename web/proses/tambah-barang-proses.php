<?php
require '../koneksi.php';

$nama_barang = $_POST['nama_barang'];
$jumlah_barang = $_POST['jumlah_barang'];
$kelas = $_POST['kelas'];
$kondisi = $_POST['kondisi'];
$foto = $_POST['foto'];

$query = "INSERT INTO barang VALUES('','$nama_barang','$jumlah_barang','$kelas','$kondisi','$foto')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=barang'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=barang'>";
}
