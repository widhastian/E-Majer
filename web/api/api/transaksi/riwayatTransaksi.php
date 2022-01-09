<?php
include "../../koneksi.php";

if (function_exists($_GET['fungsi'])) {
    $_GET['fungsi']();
}

function get_all_transaksi()
{
    global $koneksi;
    $iduser = $_POST['id'];

    $dataTransaksi = [];
    $sql = $koneksi->query("SELECT * FROM transaksi WHERE id_akun='$iduser'");
    while ($dt = mysqli_fetch_assoc($sql)) {

        $detailTransaksi = [];
        $sqll = $koneksi->query("SELECT * FROM transaksi_detail d
                            INNER JOIN minggu m WHERE d.id_minggu=m.id_minggu AND d.id_transaksi = '$dt[id_transaksi]'");

        while ($dt2 = mysqli_fetch_assoc($sqll)) {

            $detailTransaksi[] = array(
                "id_transaksi_detail" => (int)$dt2['id_transaksi_detail'],
                "id_transaksi" => (int)$dt2['id_transaksi'],
                "id_minggu" => (int)$dt2['id_minggu'],
                "nominal" => (int)$dt2['nominal'],
                "keterangan" => $dt2['keterangan']
            );
        }

        $dataTransaksi[] = [
            'id_transaksi' => (int)$dt['id_transaksi'],
            'tanggal_bayar' => $dt['tanggal_bayar'],
            'total' => (int)$dt['total'],
            'status' => $dt['status'],
            'riwayatDetail' => $detailTransaksi,
        ];
    }

    if (!empty($dataTransaksi)) {
        $response = array(
            'kode' => 1,
            'message' => 'Success',
            'riwayatAll' => $dataTransaksi
        );
    } else {
        $response = array(
            'kode' => 1,
            'message' => 'Tidak ada Transaksi',
            'riwayatAll' => $dataTransaksi
        );
    }


    header('Content-Type: application/json');
    echo json_encode($response);
}
