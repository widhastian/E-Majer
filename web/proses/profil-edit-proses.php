<?php
require '../koneksi.php';

$judul = $_GET['judul'];
$id = $_POST['id_akun'];
$nama = $_POST['nama_lengkap'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "UPDATE akun SET nama='$nama',email='$email',username='$username',password='$password' WHERE id_akun='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=profil&judul=$judul'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=profil&judul=$judul'>";
}
