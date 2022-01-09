<?php
include "../../koneksi.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST["id_akun"];

    $perintah = "SELECT * FROM akun WHERE id_akun = '$id'";
    $eksekusi = mysqli_query($koneksi, $perintah);
    $cek      = mysqli_affected_rows($koneksi);

    if ($cek > 0) {
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
        $response["data"] = array();

        while ($ambil = mysqli_fetch_object($eksekusi)) {
            $F["id_akun"] = $ambil->id_akun;
            $F["nama"] = $ambil->nama;
            $F["email"] = $ambil->email;
            $F["username"] = $ambil->username;
            $F["password"] = $ambil->password;
            $F["id_kelas"] = $ambil->id_kelas;

            array_push($response["data"], $F);
        }
    } else {
        $response["kode"] = 0;
        $response["pesan"] = "Data Tidak Tersedia";
    }
} else {
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($koneksi);
