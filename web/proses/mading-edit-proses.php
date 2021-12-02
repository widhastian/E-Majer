<?php
require '../koneksi.php';

$id = $_POST['id'];
$pengumuman = $_POST['pengumuman'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];
$kelas = $_POST['kelas'];

$query = "UPDATE mading SET jenis_mading = '$pengumuman', deskripsi_mading = '$deskripsi', tgl_pembagian = '$tanggal', id_kelas = '$kelas' WHERE id_mading = '$id'";
$result = mysqli_query($koneksi, $query);
if ($result) {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=mading'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=mading'>";
}
