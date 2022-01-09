<?php
include "../../koneksi.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST["id_kelas"];

    $perintah = "SELECT * FROM saldo WHERE id_kelas = '$id'";
    $eksekusi = mysqli_query($koneksi, $perintah);
    $cek      = mysqli_affected_rows($koneksi);

    if ($cek > 0) {
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
        $response["data"] = array();

        while ($ambil = mysqli_fetch_object($eksekusi)) {
            $F["id_saldo"] = $ambil->id_saldo;
            $F["id_kelas"] = $ambil->id_kelas;
            $F["jumlah_saldo"] = $ambil->jumlah_saldo;

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
