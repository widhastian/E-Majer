<?php
require '../koneksi.php';

$id = $_POST['id'];
$nama_barang = $_POST['nama_barang'];
$jumlah_barang = $_POST['jumlah_barang'];
$kelas = $_POST['kelas'];
$kondisi = $_POST['kondisi'];
$foto = $_POST['foto'];

$query = "UPDATE barang SET Nama_barang = '$nama_barang', jumlah_barang = '$jumlah_barang', id_kelas = '$kelas', kondisi = '$kondisi', foto = '$foto' WHERE id_barang = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=barang'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=barang'>";
}
