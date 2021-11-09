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

    <title>Document</title>
</head>

<body id="register">
    <div class="container">
        <a href="" class="back"><i class="fas fa-chevron-left"></i><b>Kembali</b></a>
        <p class="p1">Mendaftar sebagai Anggota Kelas</p>
        <form action="register-proses.php" method="POST" onsubmit="return register()">
            <input type="text" class="input" id="nama" name="nama" placeholder="Nama Lengkap"><br>
            <input type="text" class="input" id="username" name="username" placeholder="Username"><br>
            <input type="email" class="input" id="email" name="email" placeholder="Email"><br>
            <input type="password" class="input" id="password" name="password" placeholder="Password"><br>
            <input type="password" class="input" id="cpassword" placeholder="Konfirmasi Password"><br>
            <input type="text" class="input" id="kelas" name="kodeKelas" placeholder="Kode Kelas"><br>
            <p class="p2">Atau</p>
            <button class="btn-goggle"><img src="assets/gambar/icon google.png"> Lanjutkan dengan Google</button><br>
            <input type="submit" value="Buat Akun">
            <p class="daftar">Sudah punya akun? <a href="login.php">Masuk</a></p>
        </form>
    </div>
    <script>
        var input = document.querySelectorAll('.input');
        for (let i = 0; i < input.length; i++) {
            input[i].onclick = function() {
                let j = 0;
                while (j < input.length) {
                    input[j++].style.outline = "none";
                }
                input[i].style.outline = "2px solid #FEBE10";
            }

            var nama = document.getElementById('nama');
            var username = document.getElementById('username');
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var cpassword = document.getElementById('cpassword');
            var kode = document.getElementById('kelas');

            function register() {
                if (nama.value == "") {
                    alert("Nama Tidak Boleh Kosong");
                    return false;
                } else if (username.value == "") {
                    alert("Username Tidak Boleh Kosong");
                    return false;
                } else if (email.value == "") {
                    alert("Email Tidak Boleh Kosong");
                    return false;
                } else if (password.value == "") {
                    alert("Password Tidak Boleh Kosong");
                    return false;
                } else if (cpassword.value == "") {
                    alert("Konfirmasi Password Tidak Boleh Kosong");
                    return false;
                } else if (cpassword.value != password.value) {
                    alert("Masukkan Password yang benar");
                    return false;
                } else if (kode.value == "") {
                    alert("Kode Kelas Tidak Boleh Kosong");
                    return false;
                }
            }
        }
    </script>

</html>