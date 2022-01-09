<?php
include "../../koneksi.php";

if (function_exists($_GET['fungsi'])) {
    $_GET['fungsi']();
}
function get_all_barang()
{
    global $koneksi;
    $idKelas = $_POST['id'];
    $sql = $koneksi->query("SELECT * FROM barang WHERE id_kelas='$idKelas'");

    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = [
            'id_barang' => $row['id_barang'],
            'Nama_barang' => $row['Nama_barang'],
            'jumlah_barang' => $row['jumlah_barang'],
            'id_kelas' => $row['id_kelas'],
            'kondisi' => $row['kondisi'],
            'foto' => $row['foto'],
        ];
    }
    if (!empty($data)) {
        $response = array(
            'status' => 0,
            'message' => 'Success',
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 1,
            'message' => 'Tidak ada barang',
        );
    }


    header('Content-Type: application/json');
    echo json_encode($response);
}
