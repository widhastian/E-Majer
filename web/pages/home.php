<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <h5 class="text">Dashboard</h5>
        <div class="notif">
            <i class="fas fa-bell n"></i>
        </div>
        <div class="setting">
            <i class="fas fa-cog s"></i>
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
                            <a href="navbar.php?p=kelas"><button><i class="fas fa-landmark"></i> Detail kelas</button></a>
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
                    $result = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE nama_kelas='$kelas' AND status ='2' GROUP BY tanggal_transaksi");
                    while ($row = mysqli_fetch_array($result)) {
                        $date   =  Date($row['tanggal_transaksi']); ?> "<?= $date ?>",
                    <?php
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Bayar',
                    data: [
                        <?php
                        $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM transaksi WHERE nama_kelas='$kelas' AND status ='2' GROUP BY tanggal_transaksi");
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
                }, {
                    label: 'Belum Bayar',
                    data: [
                        <?php
                        $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM transaksi WHERE nama_kelas='$kelas' AND status ='1' GROUP BY tanggal_transaksi");
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