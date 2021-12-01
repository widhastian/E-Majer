<?php
require '../koneksi.php';

$id = $_POST['id'];
$nama_barang = $_POST['nama_barang'];
$jumlah_barang = $_POST['jumlah_barang'];
$kelas = $_POST['kelas'];
$kondisi = $_POST['kondisi'];

if (isset($_POST['btn-tambah'])) {
    extract($_POST);
    $nama_file   = $_FILES['foto']['name'];
    if (!empty($nama_file)) {
        // Baca lokasi file sementar dan nama file dari form (fupload)
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
        $file_foto = "barang" . $id . "." . $tipe_file;

        // Tentukan folder untuk menyimpan file
        $folder = "../assets/gambar/$file_foto";
        // Apabila file berhasil di upload
        move_uploaded_file($lokasi_file, "$folder");
    } else
        $file_foto = "-";

    $query = "INSERT INTO barang VALUES('','$nama_barang','$jumlah_barang','$kelas','$kondisi','$file_foto')";
    $result = mysqli_query($koneksi, $query);
    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=barang'>";
}
