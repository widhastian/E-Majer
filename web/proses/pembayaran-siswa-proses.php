<?php
require '../koneksi.php';

$id = "TR-" . mt_rand(1000, 99999);
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$tanggal = $_POST['tanggal'];
$nominal = $_POST['nominal'];
$id2 = $_POST['id2'];

$query = "INSERT INTO transaksi VALUES('$id','$nama','$kelas','$tanggal','$nominal',2)";
$result = mysqli_query($koneksi, $query);
$query = "UPDATE akun SET saldo = saldo+'$nominal' WHERE id_akun = '$id2'";
$result1 = mysqli_query($koneksi, $query);
$query = "UPDATE akun SET saldo = saldo-'$nominal' WHERE id_akun = '$nama'";
$result2 = mysqli_query($koneksi, $query);
if ($result && $result1 && $result2) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pengeluaran-siswa'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pengeluaran-siswa'>";
}
