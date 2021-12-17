<?php
date_default_timezone_set('Asia/Jakarta');
require_once("../assets/dompdf/autoload.inc.php");
include "../koneksi.php";
include "../proses/date.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$id = $_GET['id'];
$kelas = $_GET['kelas'];
$date = $_GET['minggu'];
$query = mysqli_query($koneksi, "SELECT * FROM akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas WHERE akun.id_akun = '$id'");
$r_data = mysqli_fetch_array($query);
$nama = $r_data['nama'];
$kelass = $r_data['nama_kelass'];

$query1 = mysqli_query($koneksi, "SELECT * FROM minggu WHERE id_minggu = '$date'");
$r_tanggal = mysqli_fetch_array($query1);
$tanggal = $r_tanggal['tanggal'];

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
<p class="p2">' . $kelass . ' - ' . $nama . '</p><br><br>
<p align="right" class="p3">Tanggal : ' . convertDateDBtoIndo($tanggal) . '</p><br><br>
<table width="100%" class="table1">
        <tr align="center">
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Tanggal Pembayaran</th>
            <th>Tanggal Transaksi</th>
            <th>Nominal Transaksi</th>
            <th>status</th>
        </tr>';
$nomor = 1;
$query = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun INNER JOIN kelas On akun.id_kelas = kelas.id_kelas INNER JOIN minggu ON transaksi.id_minggu = minggu.id_minggu  WHERE akun.id_kelas = '$kelas' AND 
minggu.id_minggu = '$date' AND transaksi.status >= 1  ORDER BY akun.nama ASC";
$q_tampil_transaksi = mysqli_query($koneksi, $query);
if (mysqli_num_rows($q_tampil_transaksi) > 0) {
    while ($r_tampil_transaksi = mysqli_fetch_array($q_tampil_transaksi)) {

        $html .= '<tr align="center">

<td>' . $nomor . '</td>
<td>' . $r_tampil_transaksi['nama'] . '</td>
 <td>' . $r_tampil_transaksi['tanggal_pembayaran'] . '</td>
 <td>' . $r_tampil_transaksi['tanggal'] . '</td>
 <td>' . $r_tampil_transaksi['nominal_transaksi'] . '</td>';
        if ($r_tampil_transaksi['status'] == 1) {
            $html .= '<td>Belum Bayar</td>';
        } else  if ($r_tampil_transaksi['status'] == 2) {
            $html .= '<td>Sudah Bayar</td>';
        }
        $nomor++;
    }
}
$html .= '</tr></table></body></html>';

//download pdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf = $dompdf->output();
$time = date("Y-m-d h:i:sa");
$dompdf->stream($time . '_laporan.pdf', array('Attachment' => 0));
