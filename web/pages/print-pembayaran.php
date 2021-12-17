<?php
date_default_timezone_set('Asia/Jakarta');
require_once("../assets/dompdf/autoload.inc.php");
include "../koneksi.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/table.css">
    <!-- font awesome -->
    <title>Document</title>
</head>';
$html .= '<body>
        <p class="p1">Data Pembayaran Kas Siswa</p><br>
        <p class="p2">TIF B - Muhammad Yusril Amin</p><br><br>
        <p align="right" class="p3">Tanggal : 8 November 2021</p><br><br>
    <table width="100%" class="table1">
        <tr align="center">
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Tanggal Transaksi</th>
            <th>Nominal Transaksi</th>
            <th>status</th>
        </tr>';
//akun.id_kelas = '$kelas' AND transaksi.tanggal_transaksi = '$date' AND
//INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN kelas On akun.id_kelas = kelas.id_kelas WHERE transaksi.status >= 1  ORDER BY akun.nama ASC
$nomor = 1;
$query = "SELECT * FROM transaksi ";
$q_tampil_transaksi = mysqli_query($koneksi, $query);
if (mysqli_num_rows($q_tampil_transaksi) > 0) {
    while ($q_tampil_transaksi = mysqli_fetch_array($q_tampil_transaksi)) {
        $html .= '
        <tr align="center">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>    
    </body>
    ';
        $nomor++;
    }
}
$html .= '</html>';

//download pdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf = $dompdf->output();
$time = date("Y-m-d h:i:sa");
$dompdf->stream($time . '_laporan.pdf', array('Attachment' => 0));
