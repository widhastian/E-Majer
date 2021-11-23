<?php
require 'koneksi.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$kodeKelas = $_POST['kelas'];

$query = "INSERT INTO akun VALUES('','admin','$email','$username','$password','$kodeKelas',1)";
$result = mysqli_query($koneksi, $query);

if ($result) {
    header('Location:register(admin1).php?email=' . $email);
} else {
    echo "<script>alert('Akun gagal Dibuat');</script>";
    echo "<meta http-equiv='refresh' content='0; url=register(admin).php'>";
}
