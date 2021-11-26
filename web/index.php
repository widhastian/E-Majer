<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/kalender.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="../assets/js/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">E-Majer</span>
        </div>
        <div class="profil-box">
            <img src="assets/gambar/avatar53.png" alt="">
            <div class="profil-name">
                <p class="nama">M. Yusril Amin</p>
                <p class="level">Admin</p>
            </div>
        </div>
        <ul class="nav-links">
            <li>
                <div class="li">
                    <a href="index.php?p=home">
                        <i class='bx bxs-home'></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Dashboard</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="li">
                    <a href="index.php?p=barang">
                        <i class='bx bx-clipboard'></i>
                        <span class="link_name">Data Barang</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Data Barang</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="li">
                    <a href="index.php?p=pembayaran">
                        <i class='bx bxs-credit-card'></i>
                        <span class="link_name">Transaksi Pembayaran</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Transaksi Pembayaran</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="li">
                    <a href="index.php?p=pengeluaran">
                        <i class='bx bx-credit-card'></i>
                        <span class="link_name">Transaksi Pengeluaran</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Transaksi Pengeluaran</a></li>
                    </ul>
                </div>
            </li>

            <li>
                <div class="li">
                    <a href="index.php?p=mading">
                        <i class='bx bx-news'></i>
                        <span class="link_name">Mading</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Mading</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-log-out'></i>
                    <span class="link_name">Logout</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">logout</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <?php
    $pages_dir = 'pages';
    if (!empty($_GET['p'])) {
        $pages = scandir($pages_dir, 0);
        unset($pages[0], $pages[1]);
        $p = $_GET['p'];
        if (in_array($p . '.php', $pages)) {
            include($pages_dir . '/' . $p . '.php');
        } else {
            echo 'Halaman Tidak Ditemukan';
        }
    } else {
        include($pages_dir . '/home.php');
    }
    ?>
    <script>
        function GetURLParameter(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) {
                    return sParameterName[1];
                }
            }
        }
        var pages = GetURLParameter('p');

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        var close = document.getElementsByClassName("close");

        var list = document.querySelectorAll('.li');
        for (let i = 0; i < list.length; i++) {
            if (pages === "home") {
                list[0].className = 'li active';
            } else if (pages === "barang") {
                list[1].className = 'li active';
            } else if (pages === "pembayaran") {
                list[2].className = 'li active';
            } else if (pages === "pengeluaran") {
                list[3].className = 'li active';
            } else if (pages === "mading") {
                list[4].className = 'li active';
            }

            list[i].onclick = function() {
                let j = 0;
                while (j < list.length) {
                    list[j++].className = 'li';
                }
                list[i].className = 'li active';
            }
        }
    </script>
</body>

</html>