<?php
include "../../koneksi.php";

if (function_exists($_GET['fungsi'])) {
    $_GET['fungsi']();
}

function get_minggu_id()
{
    global $koneksi;
    $iduser = $_POST['id'];

    $sql = $koneksi->query("SELECT * FROM minggu m WHERE NOT EXISTS (
        SELECT id_minggu FROM transaksi_detail d INNER JOIN transaksi t 
        WHERE m.id_minggu=d.id_minggu AND t.id_akun ='$iduser')");

    while ($row = mysqli_fetch_assoc($sql)) {
        // $hutang += $row['nominal'];
        $data[] = [
            'id_minggu' => (int)$row['id_minggu'],
            'nominal' => (int)$row['nominal'],
            'keterangan' => $row['keterangan']
        ];
    }
    if (!empty($data)) {
        $response = array(
            'status' => 1,
            'message' => 'Success',
            // 'hutang' => $hutang,
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 1,
            'message' => 'Tidak ada tagihan',
        );
    }


    header('Content-Type: application/json');
    echo json_encode($response);
}

function input_transaksi()
{
    global $koneksi;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $idAkun = $data['id_akun'];
        $idKelas = $data['id_kelas'];
        $total = $data['total'];
        $allTransaksi = $data['transaksiDetail'];

        $koneksi->query("INSERT INTO transaksi(id_akun,id_kelas,total,status)
         VALUES ('$idAkun','$idKelas',$total,'veirifikasi')");
        $id_transaksi_barusan = mysqli_insert_id($koneksi);

        foreach ($allTransaksi as $item) {
            $koneksi->query("INSERT INTO transaksi_detail(id_transaksi,id_minggu)
        VALUES ('$id_transaksi_barusan','$item[id_minggu]')");
        }

        $response = array(
            'status' => 1,
            'message' => 'Success Input Transaksi',
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
