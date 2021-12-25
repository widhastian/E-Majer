<?php
session_start();
if (isset($_POST['btn-next'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    echo "<meta http-equiv='refresh' content='0; url=input-kelas.php'>";
}
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
    <p class="container">
    <div class="indikator" style="padding-left: 37%;">
        <div style="display: block;">
            <div class="elips">1</div>
            <p class="verified">Email</p>
        </div>
        <hr>
        <div style="display: block;">
            <div class="elips1">2</div>
            <p class="none">Kelas</p>
        </div>
        <hr>
        <div style="display: block;">
            <div class="elips1">3</div>
            <p class="none">Profil</p>
        </div>
    </div>
    <p class="p1">Mendaftar sebagai Pengurus kelas</p>
    <button class="btn-goggle"><img src="assets/gambar/icon google.png"> Lanjutkan dengan Google</button>
    <p class="p2">Atau</p>
    <form action="" method="POST" onsubmit="return register()">
        <input type="text" style="height:35px" class="input" id="email" name="email" placeholder="Email"><br>
        <input type="text" style="height:35px" class="input" id="username" name="username" placeholder="Username"><br>
        <input type="password" style="height:35px" class="input" id="password" name="password" placeholder="password"><br>
        <input type="password" style="height:35px" class="input" id="cpassword" placeholder="Konfirm password"><br>
        <input type="submit" value="Selanjutnya" style="height:35px" name="btn-next">
        <p class="register">Sudah punya akun? <a href="login.php">Masuk</a></p>
    </form>
    </div>
    <script>
        function pesan(judul, status) {
            swal.fire({
                title: judul,
                icon: status,
                confirmButtonColor: '#6777ef',
            });
        }

        var input = document.querySelectorAll('.input');
        for (let i = 0; i < input.length; i++) {
            input[i].onclick = function() {
                let j = 0;
                while (j < input.length) {
                    input[j++].style.outline = "none";
                }
                input[i].style.outline = "2px solid #FEBE10";
            }

            var username = document.getElementById('username');
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var cpassword = document.getElementById('cpassword');
            var kode = document.getElementById('kelas');

            function register() {
                if (email.value == "") {
                    pesan("Email Tidak Boleh Kosong", "warning", "warning");
                    return false;
                } else if (username.value == "") {
                    pesan("Username Tidak Boleh Kosong", "warning");
                    return false;
                } else if (password.value == "") {
                    pesan("Password Tidak Boleh Kosong", "warning");
                    return false;
                } else if (cpassword.value == "") {
                    pesan("Konfirmasi Password Tidak Boleh Kosong", "warning");
                    return false;
                } else if (cpassword.value != password.value) {
                    pesan("Masukkan Password yang benar", "warning");
                    return false;
                } else if (kode.value == "") {
                    pesan("Kode Kelas Tidak Boleh Kosong", "warning");
                    return false;
                }
            }
        }
    </script>

</html>