<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <h5 class="text">Dashboard</h5>
        <button class="notif" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fas fa-bell n"></i>
        </button>
        <!-- Scrollable modal -->
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $result = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON minggu.id_minggu = transaksi_detail.id_minggu INNER JOIN akun ON transaksi.id_akun = akun.id_akun WHERE transaksi.id_kelas = '$kelas' AND akun.id_level = 2 ORDER BY transaksi.tanggal_bayar DESC");
                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_array($result)) { ?>
                                <div class="isi-notif">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="assets/gambar/transfer.png" alt="" width="70px">
                                        </div>
                                        <div class="col-md-8">
                                            <p class="p"><?= $data['nama'] ?> Telah Membayar Kas Dengan Nominal <?= "Rp. " . number_format($data['nominal'], 0, ".", ".") ?></p>
                                        </div>
                                        <div class="col-md-2">
                                            <p class="tanggal1"><?= $data['tanggal_bayar'] ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p align='center'>Tidak Ada Notification</p>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="setting">
            <a href="navbar.php?p=profil&judul=Setting Profil" style="color: black;"><i class="fas fa-cog s"></i></a>
        </div>
    </div>

    <div class="dashboard">
        <p class="p">Selamat Datang <?= $nama ?></p>
        <div style="display: flex;">
            <div class="box1">
                <p style="font-size: 12px; padding-top:10px;">Transaksi Bendahara</p>
                <canvas id="myChart" style="height: 0.5px; position:relative; top:-35px;"></canvas>
            </div>
            <div style="display: block; width:25%;">
                <div class="box-saldo" style="margin-bottom: 1rem;">
                    <div class="color-box" style="background: #FEBE10;">
                    </div>
                    <div class="text">
                        <p class="judul">Jumlah saldo</p>
                        <p class="kelas"><?= $row['nama_kelas']; ?></p>
                        <p class="saldo">Rp. <?= number_format($saldo, 0, ".", ".") ?>;-</p>
                    </div>
                </div>
                <div class="box-kelas">
                    <div class="color-box" style="background: #EA0E0E;">
                    </div>
                    <div class="text">
                        <p class="judul">Kelas Saya</p>
                        <p class="kelas"><?= $row['nama_kelas']; ?></p>
                        <hr>
                        <center>
                            <a href="navbar.php?p=kelas&judul=Detail Kelas"><button><i class="fas fa-landmark"></i> Detail kelas</button></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: flex; margin-bottom:0.8%;">
            <div class="box2">
                <p style="font-size: 12px; padding-top:10px;">Transaksi Pengeluaran</p>
                <canvas id="myChart2" style="height: 0.5px; position:relative; top:-35px;"></canvas>
            </div>
            <div class="box-calender">
                <?php
                include "kalender.php";
                $date = getdate();
                echo draw_calendar($date["mon"], $date["year"]);
                ?>
            </div>
        </div>
    </div>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    <?php
                    $result = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON minggu.id_minggu = transaksi_detail.id_minggu WHERE transaksi.id_kelas ='$kelas' GROUP BY minggu.tanggal DESC");
                    while ($row = mysqli_fetch_array($result)) {
                        $date   =  $row['tanggal']; ?> "<?= $date ?>",
                    <?php
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Belum Bayar',
                    data: [
                        <?php
                        $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON minggu.id_minggu = transaksi_detail.id_minggu WHERE transaksi.id_kelas ='$kelas' AND transaksi.status ='sudah bayar' GROUP BY minggu.tanggal DESC");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $bayar = $row['total'];
                        ?>
                                <?= $bayar ?>,
                        <?php
                            }
                        }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                    ],
                    borderWidth: 1
                }, {
                    label: 'Verifikasi',
                    data: [
                        <?php
                        $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON minggu.id_minggu = transaksi_detail.id_minggu WHERE transaksi.id_kelas ='$kelas' AND transaksi.status ='veirifikasi' GROUP BY minggu.tanggal DESC");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $bayar = $row['total'];
                        ?>
                                <?= $bayar ?>,
                        <?php
                            }
                        }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(254, 190, 16, 0.2)'
                    ],
                    borderColor: [
                        'rgba(254, 190, 16, 1)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Bayar',
                    data: [
                        <?php
                        $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON minggu.id_minggu = transaksi_detail.id_minggu WHERE transaksi.id_kelas ='$kelas' AND transaksi.status ='belum bayar' GROUP BY minggu.tanggal DESC");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $bayar = $row['total'];
                        ?>
                                <?= $bayar ?>,
                        <?php
                            }
                        }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx2 = document.getElementById("myChart2").getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [
                    <?php
                    $result = mysqli_query($koneksi, "select * from pengeluaran where nama_kelas='$kelas' ");
                    while ($row = mysqli_fetch_array($result)) {
                        $date   =  Date($row['tgl_pengeluaran']); ?> "<?= $date ?>",
                    <?php
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Pengeluaran',
                    data: [
                        <?php
                        $result = mysqli_query($koneksi, "select * from pengeluaran where nama_kelas='$kelas'");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $pengeluaran = $row['nominal_pengeluaran'];
                        ?>
                                <?= $pengeluaran ?>,
                        <?php
                            }
                        }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(0, 22, 220, 0.3)'
                    ],
                    borderColor: [
                        'rgba(0, 22, 220, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>