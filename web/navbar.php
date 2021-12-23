<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['id_akun'])) {
    $_SESSION['msg'] = "anda harus login untuk mengakses halaman ini!!";
    header("Location :login.php");
}
$id = $_SESSION['id_akun'];
$kelas = $_SESSION['id_kelas'];
$level = $_SESSION['id_level'];

$query = "SELECT * FROM akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas INNER JOIN level ON akun.id_level = level.id_level INNER JOIN saldo ON kelas.id_kelas = saldo.id_kelas WHERE akun.id_akun = '$id'";
$result = mysqli_query($koneksi, $query);
$no = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $nominal = $row['nominal_uangkas'];
        $saldo = $row['jumlah_saldo'];
        $nama = $row['nama'];
?>
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
            <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.1/chart.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
            </script>

            <!-- font awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <title>Document</title>
        </head>

        <body>
            <div class="sidebar">
                <div class="logo-details">
                    <i class='bx bxl-c-plus-plus'></i>
                    <span class="logo_name">E-Majer</span>
                </div>
                <div class="profil-box">
                    <img src="assets/gambar/avatar53.png" alt="">
                    <div class="profil-name">
                        <p class="nama"><?= $nama ?></p>
                        <p class="level"><?= $row['nama_level'] ?></p>
                    </div>
                </div>
                <ul class="nav-links">
                    <li>
                        <div class="li">
                            <a href="navbar.php?p=home">
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
                            <a href="navbar.php?p=barang">
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
                            <?php if ($level == 1) { ?>
                                <a href="navbar.php?p=buku-transaksi">
                                    <i class='bx bxs-credit-card'></i>
                                    <span class="link_name">Transaksi Pembayaran</span>
                                </a>
                            <?php } else { ?>
                                <a href="navbar.php?p=pembayaran-siswa">
                                    <i class='bx bxs-credit-card'></i>
                                    <span class="link_name">Transaksi Pembayaran</span>
                                </a>
                            <?php } ?>
                            <ul class="sub-menu blank">
                                <li><a class="link_name" href="#">Transaksi Pembayaran</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="li">
                            <?php if ($level == 1) { ?>
                                <a href="navbar.php?p=pengeluaran">
                                    <i class='bx bx-credit-card'></i>
                                    <span class="link_name">Transaksi Pengeluaran</span>
                                </a>
                            <?php } else { ?>
                                <a href="navbar.php?p=pengeluaran-siswa">
                                    <i class='bx bx-credit-card'></i>
                                    <span class="link_name">Riwayat Transaksi</span>
                                </a>
                            <?php } ?>
                            <ul class="sub-menu blank">
                                <li><a class="link_name" href="#">Transaksi Pengeluaran</a></li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <div class="li">
                            <a href="navbar.php?p=mading">
                                <i class='bx bx-news'></i>
                                <span class="link_name">Mading</span>
                            </a>
                            <ul class="sub-menu blank">
                                <li><a class="link_name" href="#">Mading</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="logout1">
                            <div class="logout">
                                <i class='bx bx-log-out'></i>
                                <span class="link_name">Logout</span>
                            </div>
                            <ul class="sub-menu blank">
                                <li><a class="link_name" href="#">logout</a></li>
                            </ul>
                        </div>
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
                    if (pages === "home" || pages === "kelas" || pages === "profil") {
                        list[0].className = 'li active';
                    } else if (pages === "barang" || pages === "barang-edit") {
                        list[1].className = 'li active';
                    } else if (pages === "pembayaran" || pages === "pembayaran-siswa" || pages === "buku-transaksi") {
                        list[2].className = 'li active';
                    } else if (pages === "pengeluaran" || pages === "pengeluaran-edit" || pages === "detail" || pages === "detail-edit" || pages == "pengeluaran-siswa") {
                        list[3].className = 'li active';
                    } else if (pages === "mading" || pages === "mading-edit") {
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

                var logout = document.querySelector('.logout');
                logout.addEventListener("click", onClick);

                function onClick() {
                    swal.fire({
                        title: "Anda Yakin logout?",
                        icon: "warning",
                        closeOnClickOutside: false,
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        confirmButtonColor: '#6777ef',
                        cancelButtonText: 'Cancel',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "logout.php";
                        }
                    });
                }
            </script>
        </body>

        </html>
<?php }
} ?>