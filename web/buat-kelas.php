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
    <title>Document</title>
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
                <p class="verified" style="margin-left: 2px; position: absolute; top: -5.6rem;">Kelas</p>
            </div>
            <hr>
            <div style="display: block;">
                <div class="elips1">3</div>
                <p class="none">Profil</p>
            </div>
        </div>
        <img src="assets/gambar/verifikasi.png" alt="" class="img" width="20%">
        <p class="p3" style="font-size: 16px;">Masukkan Kode Kelas</p>
        <p class="p5" style="color: #7A7A7A; font-size: 14px; margin-top:0.5%; text-align :center;">Silahkan Masukkan Kode Kelas Atau Jika ingin Membuat<br> Kelas Baru Klik <a href="buat-kelas.php">Disini</a> </u>
        </p>
        <form action="tambah-kelas-proses.php" method="POST" onsubmit="return tambah()">
            <input type="text" class="input2" id="kelas" name="kelas" placeholder="Nama Kelas"><br>
            <input type="text" class="input2" id="nominal" name="nominal" placeholder="Nominal Uang Kas"><br>
            <div class="button">
                <input type="submit" class="kirim" value="Selanjutnya" name="btn-next">
            </div>
        </form>
        <script>
            function pesan(judul, status) {
                swal.fire({
                    title: judul,
                    icon: status,
                    confirmButtonColor: '#6777ef',
                });
            }

            var input = document.querySelector('.input2');
            input.addEventListener("click", function(e) {
                input.style.outline = "2px solid #FEBE10";
            });

            var kelas = document.getElementById('kelas');
            var nominal = document.getElementById('nominal');

            function tambah() {
                if (kelas.value == "") {
                    pesan("Nama Kelas Tidak Boleh Kosong", "warning");
                    return false;
                } else if (nominal.value == "") {
                    pesan("Nominal Uang Kas Tidak Boleh Kosong", "warning");
                    return false;
                }
            }
        </script>

</html>