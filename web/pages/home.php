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
            </div>
            <div style="display: block; width:25%;">
                <div class="box-saldo" style="margin-bottom: 1rem;">
                    <div class="color-box" style="background: #FEBE10;"></div>
                    <div class="text">
                        <p class="judul">Jumlah saldo</p>
                        <p class="kelas"><?= $row['nama_kelas']; ?></p>
                        <p class="saldo">Rp. <?= number_format($saldo, 0, ".", ".") ?>;-</p>
                    </div>
                </div>
                <div class="box-kelas">
                    <div class="color-box" style="background: #EA0E0E;"></div>
                    <div class="text">
                        <p class="judul">Kelas Saya</p>
                        <p class="kelas"><?= $row['nama_kelas']; ?></p>
                        <hr>
                        <center>
                            <a href=""><button><i class="fas fa-landmark"></i> Detail kelas</button></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: flex;">
            <div class="box2">

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
</section>