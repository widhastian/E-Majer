<?php
session_start();

$kelas = $_SESSION['kelas'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="assets/js/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Register</title>
</head>

<body id="daftar2">
    <div class="container">
        <div class="indikator">
            <div style="display: block;">
                <div class="elips">1</div>
                <p class="verified">Email</p>
            </div>
            <hr>
            <div style="display: block;">
                <div class="elips">2</div>
                <p class="verified">Kelas</p>
            </div>
            <hr>
            <div style="display: block;">
                <div class="elips1">3</div>
                <p class="none">Profil</p>
            </div>
        </div>
        <img src="assets/gambar/verifikasi.png" alt="" class="img" width="28%">
        <p class="p3" style="font-size: 16px;">Sukses!</p>
        <p class="p5" style="margin-top: -0.3rem; text-align:center;">Kelas Berhasil Dibuat, Bagikan Kode <b><?= $kelas ?></b> Agar<br> Dapat Bergabung Dengan Kelas Anda</p>
        <a href="lengkapi-profil.php"><button class="next" style="width: 30%;">Selanjutnya</button></a>
    </div>

</html>