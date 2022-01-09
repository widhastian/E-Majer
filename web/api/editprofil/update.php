<?php
include "../../koneksi.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST["id_akun"];
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $id_kelas = $_POST["id_kelas"];

    $perintah = "UPDATE akun SET nama = '$nama', email = '$email', username = '$username', password = '$password', id_kelas = '$id_kelas' WHERE id_akun = '$id'";
    $eksekusi = mysqli_query($koneksi, $perintah);
    $cek      = mysqli_affected_rows($koneksi);

    if ($cek > 0) {
        $response["kode"] = 1;
        $response["pesan"] = "Data Berhasil Diubah";
    } else {
        $response["kode"] = 0;
        $response["pesan"] = "Data Gagal Diubah";
    }
} else {
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($koneksi);
