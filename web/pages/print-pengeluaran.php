<?php
date_default_timezone_set('Asia/Jakarta');
require_once("../assets/dompdf/autoload.inc.php");
include "../koneksi.php";
include "../proses/date.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$id = $_GET['id'];
$kelas = $_GET['kelas'];
$query = mysqli_query($koneksi, "SELECT * FROM akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas WHERE akun.id_akun = '$id'");
$r_data = mysqli_fetch_array($query);
$nama = $r_data['nama'];
$kelass = $r_data['nama_kelass'];

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
<p align="right" class="p3">Tanggal : ' . convertDateDBtoIndo(date("Y-m-d")) . '</p><br><br>
<table width="100%" class="table1">
        <tr align="center">
            <th>No</th>
            <th>Nominal Pengeluaran</th>
            <th>Tanggal Pengeluaran</th>
            <th>Foto</th>
        </tr>';
$nomor = 1;
$query1 = "SELECT * FROM pengeluaran INNER JOIN akun ON pengeluaran.id_akun = akun.id_akun ORDER BY pengeluaran.tgl_pengeluaran ASC";
$q_tampil_pengeluaran = mysqli_query($koneksi, $query1);
if (mysqli_num_rows($q_tampil_pengeluaran) > 0) {
    while ($r_tampil_pengeluaran = mysqli_fetch_array($q_tampil_pengeluaran)) {
        if (empty($r_tampil_pengeluaran['foto']) or ($r_tampil_pengeluaran['foto'] == '-')) {
            $foto = "papan tulis.jpg";
        } else {
            $foto = $r_tampil_pengeluaran['foto'];
        }
        $html .= '<tr align="center">

<td>' . $nomor . '</td>
<td>' . $r_tampil_pengeluaran['nominal_pengeluaran'] . '</td>
<td>' . $r_tampil_pengeluaran['tgl_pengeluaran'] . '</td>
 <td><img src="../assets/gambar/' . $foto . '" width=70px height=75px></td>';

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
