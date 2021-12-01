<?php
require '../koneksi.php';

$id = $_POST['id'];
$nama_barang = $_POST['nama_barang'];
$jumlah_barang = $_POST['jumlah_barang'];
$kelas = $_POST['kelas'];
$kondisi = $_POST['kondisi'];
$foto_akhir = $_POST['foto_awal'];

if (isset($_POST['btn-edit'])) {
    extract($_POST);
    $nama_file   = $_FILES['foto']['name'];
    if (!empty($nama_file)) {
        // Baca lokasi file sementar dan nama file dari form (fupload)
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
        $file_foto = "barang" . $id . "." . $tipe_file;
        // Tentukan folder untuk menyimpan file
        $folder = "../assets/gambar/$file_foto";
        @unlink("$folder");
        // Apabila file berhasil di upload
        move_uploaded_file($lokasi_file, "$folder");
    } else {
        $file_foto = $foto_akhir;
    }
    $query = "UPDATE barang SET Nama_barang = '$nama_barang', jumlah_barang = '$jumlah_barang', id_kelas = '$kelas', kondisi = '$kondisi', foto = '$file_foto' WHERE id_barang = '$id'";

    $result = mysqli_query($koneksi, $query);
    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=barang'>";
}
