<?php
require '../koneksi.php';

$id = $_POST['id'];
$nominal = $_POST['nominal'];
$tanggal = $_POST['tanggal'];
$akun = $_POST['akun'];
$kelas = $_POST['kelas'];
$foto_akhir = $_POST['foto_awal'];

if (isset($_POST['btn-edit'])) {
    extract($_POST);
    $nama_file   = $_FILES['foto']['name'];
    if (!empty($nama_file)) {
        // Baca lokasi file sementar dan nama file dari form (fupload)
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
        $file_foto = "Nota_" . $id . "." . $tipe_file;
        // Tentukan folder untuk menyimpan file
        $folder = "../assets/gambar/$file_foto";
        @unlink("$folder");
        // Apabila file berhasil di upload
        move_uploaded_file($lokasi_file, "$folder");
    } else {
        $file_foto = $foto_akhir;
    }
    $query = "UPDATE pengeluaran SET nominal_pengeluaran = '$nominal', tgl_pengeluaran = '$tanggal', id_akun = '$akun', nama_kelas = '$kelas', foto = '$file_foto' WHERE id_pengeluaran = '$id'";
    $result = mysqli_query($koneksi, $query);
    echo "<meta http-equiv='refresh' content='0; url=../navbar.php?p=pengeluaran'>";
}
