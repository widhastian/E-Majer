<?php
date_default_timezone_set('Asia/Jakarta');
require_once("../assets/dompdf/autoload.inc.php");
include "../koneksi.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '<center><h3>Daftar Transaksi Peminjaman</h3></center><br/>';
$html .= '<table border="1" width="100%">
 <tr>
 <th>Nomor</th>
 <th>ID Transaksi</th>
 <th>Nama</th>
 <th>Judul Buku</th>
 <th>Tanggal Peminjaman</th>
 </tr>';
$nomor = 1;
$query = "SELECT tr.idtransaksi, tag.nama, tb.judulbuku, tr.tglpinjam, tr.tglkembali FROM tbtransaksi tr INNER JOIN tbanggota tag ON tr.idanggota = tag.idanggota INNER JOIN tbbuku tb ON tr.idbuku = tb.idbuku ORDER BY tr.idtransaksi ASC";
$q_tampil_peminjaman = mysqli_query($koneksi, $query);
if (mysqli_num_rows($q_tampil_peminjaman) > 0) {
    while ($r_tampil_peminjaman = mysqli_fetch_array($q_tampil_peminjaman)) {
        $html .= "<tr>

 <td>" . $nomor . "</td>
 <td>" . $r_tampil_peminjaman['idtransaksi'] . "</td>
 <td>" . $r_tampil_peminjaman['nama'] . "</td>
 <td>" . $r_tampil_peminjaman['judulbuku'] . "</td>
 <td>" . $r_tampil_peminjaman['tglpinjam'] . "</td>

 </tr>";
        $nomor++;
    }
}
$html .= "</html>";

//download pdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$pdf = $dompdf->output();
$time = date("Y-m-d h:i:sa");
$dompdf->stream($time . '_laporan.pdf', array('Attachment' => 0));
