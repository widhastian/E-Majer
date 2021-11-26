<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <div class="notif">

        </div>
        <div class="setting">

        </div>
    </div>
    <div class="dashboard">
        <h5 class="text">Dashboard</h5>
        <p>Selamat Datang Yusril</p>
        <div style="display: flex;">
            <div class="box1">

            </div>
            <div style="display: block; width:25%;">
                <div class="box-saldo" style="margin-bottom: 1rem;">
                    <div class="color-box" style="background: #FEBE10;"></div>
                    <div class="text">
                        <p class="judul">Jumlah saldo</p>
                        <p class="kelas">TIF B</p>
                        <p class="saldo">Rp. 460.000;-</p>
                    </div>
                </div>
                <div class="box-kelas">
                    <div class="color-box" style="background: #EA0E0E;"></div>
                    <div class="text">
                        <p class="judul">kelas Saya</p>
                        <p class="kelas">TIF B</p>
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