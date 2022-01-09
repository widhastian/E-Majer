<?php
include "../../koneksi.php";

if (function_exists($_GET['fungsi'])) {
    $_GET['fungsi']();
}

function get_all_pengeluaran()
{
    global $koneksi;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id_kelas = $_POST['id_kelas'];

        $perintah = "SELECT * FROM pengeluaran INNER JOIN akun ON pengeluaran.id_akun = akun.id_akun WHERE pengeluaran.nama_kelas = '$id_kelas'";
        $eksekusi = mysqli_query($koneksi, $perintah);
        $cek      = mysqli_affected_rows($koneksi);

        if ($cek > 0) {
            $response["kode"] = 1;
            $response["pesan"] = "Data Tersedia";
            $response["data"] = array();

            while ($ambil = mysqli_fetch_object($eksekusi)) {
                $F["id_pengeluaran"] = $ambil->id_pengeluaran;
                $F["nama"] = $ambil->nama;
                $F["tgl_pengeluaran"] = $ambil->tgl_pengeluaran;
                $F["nominal_pengeluaran"] = $ambil->nominal_pengeluaran;
                $F["foto"] = $ambil->foto;

                array_push($response["data"], $F);
            }
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Data Tidak Tersedia";
            $response["data"] = [];
        }
    } else {
        $response["kode"] = 0;
        $response["pesan"] = "Tidak Ada Post Data";
    }

    echo json_encode($response);
    mysqli_close($koneksi);
}

function get_pengeluaran()
{
    global $koneksi;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $idPengeluaran = $_POST['id_pengeluaran'];

        $perintah = "SELECT * FROM pengeluaran INNER JOIN akun ON pengeluaran.id_akun = akun.id_akun INNER JOIN kelas On akun.id_kelas = kelas.id_kelas WHERE pengeluaran.id_pengeluaran = '$idPengeluaran'";
        $eksekusi = mysqli_query($koneksi, $perintah);
        $cek      = mysqli_affected_rows($koneksi);

        if ($cek > 0) {
            $response["kode"] = 1;
            $response["pesan"] = "Data Tersedia";
            $response["data"] = array();

            while ($ambil = mysqli_fetch_object($eksekusi)) {
                $F["id_pengeluaran"] = $ambil->id_pengeluaran;
                $F["nama"] = $ambil->nama_kelas;
                $F["tgl_pengeluaran"] = $ambil->tgl_pengeluaran;
                $F["nominal_pengeluaran"] = $ambil->nominal_pengeluaran;
                $F["foto"] = $ambil->foto;

                array_push($response["data"], $F);
            }
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Data Tidak Tersedia";
            $response["data"] = [];
        }
    } else {
        $response["kode"] = 0;
        $response["pesan"] = "Tidak Ada Post Data";
    }

    echo json_encode($response);
    mysqli_close($koneksi);
}

function get_detail_pengeluaran()
{
    global $koneksi;
    $idPengeluaran = $_POST['id_pengeluaran'];

    $sql = $koneksi->query("SELECT jumlah,nama_barang FROM detail_pengeluaran pd INNER JOIN barang b ON pd.id_barang=b.id_barang WHERE pd.id_pengeluaran='$idPengeluaran'");
    while ($row = mysqli_fetch_assoc($sql)) {
        // $hutang += $row['nominal'];
        $data[] = [
            'jumlahBeli' => (int)$row['jumlah'],
            'namaBarang' => $row['nama_barang']
        ];
    }

    if (!empty($data)) {
        $response = array(
            'status' => 1,
            'message' => 'Success (detail pengeluaran)',
            'dataPengeluaranDetail' => $data
        );
    } else {
        $response = array(
            'status' => 1,
            'message' => 'Tidak ada Pengeluaran',
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
