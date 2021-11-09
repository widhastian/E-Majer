<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="../assets/js/jquery-3.4.1.js"></script>
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

<body id="login">
    <div class="container" onsubmit="return clickLogin()">
        <p class="p1">Selamat Datang kembali!<br>Masuk ke akun E-Majer anda dan nikmati pelayanannya</p>
        <button class="btn-goggle"><img src="assets/gambar/icon google.png"> Lanjutkan dengan Google</button>
        <p class="p2">Atau</p>
        <form action="login-proses.php" method="POST">
            <input type="text" class="input" id="nama" name="email" placeholder="Email atau Username"><br>
            <input type="password" class="input" id="password" name="password" placeholder="password"><br>
            <p class="forgot"><a href="">Lupa password?</a></p><br>
            <input type="submit" value="Masuk" name="btn-login">
            <p class="register">Belum punya akun? <a href="register.php">Daftar</a></p>
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
        }

        var nama = document.getElementById('nama');
        var password = document.getElementById('password');

        function clickLogin() {
            if (nama.value == "") {
                alert("Email atau Username Tidak Boleh Kosong");
                return false;
            } else if (password.value == "") {
                alert("Password Tidak Boleh Kosong");
                return false;
            }
        }
    </script>

</html>