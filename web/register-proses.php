<?php
require 'koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$kodeKelas = $_POST['kodeKelas'];

$query = "INSERT INTO akun VALUES('','$nama','$email','$username','$password','$kodeKelas',2)";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Akun Berhasil Dibuat');</script>";
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
} else {
    echo "<script>alert('Akun gagal Dibuat');</script>";
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
