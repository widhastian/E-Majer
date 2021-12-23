<?php
require 'koneksi.php';

$id = "M-" . mt_rand(1000, 99999);
$nama = $_POST['firstname'] . ' ' . $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$kodeKelas = $_POST['kelas'];

$query = "INSERT INTO akun VALUES('$id','$nama','$email','$username','$password','$kodeKelas',1)";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=berhasil-buat-akun.php'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=berhasil-buat-akun.php'>";
}
