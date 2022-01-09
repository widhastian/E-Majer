<?php
include "../../koneksi.php";

if (function_exists($_GET['fungsi'])) {
    $_GET['fungsi']();
}

function get_all_mading()
{
    global $koneksi;
    $idKelas = $_POST['id'];
    $sql = $koneksi->query("SELECT * FROM mading WHERE id_kelas='$idKelas'");

    while ($row = mysqli_fetch_assoc($sql)) {
        // $hutang += $row['nominal'];
        $data[] = [
            'id_mading' => $row['id_mading'],
            'id_kelas' => $row['id_kelas'],
            'jenis_mading' => $row['jenis_mading'],
            'deskripsi_mading' => $row['deskripsi_mading'],
            'tgl_pembagian' => $row['tgl_pembagian'],
        ];
    }
    if (!empty($data)) {
        $response = array(
            'status' => 1,
            'message' => 'Success',
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 1,
            'message' => 'Tidak ada Mading',
        );
    }


    header('Content-Type: application/json');
    echo json_encode($response);
}
