<?php
require '../koneksi.php';

$judul = $_GET['judul'];
$id = "BL-" . mt_rand(1000, 99999);
$nominal = $_POST['nominal'];
$tanggal = $_POST['tanggal'];
$akun = $_POST['akun'];
$kelas = $_POST['kelas'];

if (isset($_POST['btn-tambah'])) {
    extract($_POST);
    $nama_file   = $_FILES['foto']['name'];
    if (!empty($nama_file)) {
        // Baca lokasi file sementar dan nama file dari form (fupload)
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
        $file_foto = "Nota_" . $id . "." . $tipe_file;

        // Tentukan folder untuk menyimpan file
        $folder = "../images/nota/$file_foto";
        // Apabila file berhasil di upload
        move_uploaded_file($lokasi_file, "$folder");
    } else
        $file_foto = "-";

    $query = "INSERT INTO pengeluaran VALUES('$id','$nominal','$tanggal','$akun','$kelas','$file_foto')";
    $result = mysqli_query($koneksi, $query);

    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pengeluaran&judul=$judul'>";
}
