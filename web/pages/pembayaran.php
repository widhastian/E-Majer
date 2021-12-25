<?php
$judul = 'Pemebayaran';
$date = $_GET['minggu']; ?>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Transaksi Pembayaran</span>
    </div>
    <div class="content">
        <div class="row" style="width:97%;">
            <div class="col-md-8">
                <?php if ($level == 1) { ?>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    <a href="pages/print-pembayaran.php?id=<?= $id ?>&kelas=<?= $kelas ?>&minggu=<?= $date ?>"><button type=" button" class="btn btn-secondary"><i class="fas fa-print"></i> Print</button></a>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <form class="row g-3" style="margin-left:12.5%; margin-bottom:-15px;" method="POST">
                    <div class="col-auto">
                        <input type="text" name="pencarian" class="form-control" id="inputPassword2" placeholder="Nama Siswa">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" name="btn-cari" style="height: 40px; padding-top:8px; width:45px; padding-left:11px;"><i class='bx bx-search-alt fs-4'></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Transaksi Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses/pembayaran-tambah-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class='bx bxs-user'></i></span>
                                    <select class="form-select" id="nama" name="nama">
                                        <option value="0">-- Nama Siswa --</option>
                                        <?php
                                        require('koneksi.php');
                                        $result = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_kelas ='$kelas'");
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                <option value="<?= $row['id_akun'] ?>"><?= $row['nama'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <input type="hidden" name="kelas" value="<?= $kelas ?>">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" id="tanggal" n aria-describedby="inputGroupPrepend" name="tanggal">
                                    <input type="hidden" value="<?= $date ?>" name="minggu">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        <button type="submit" class="btn btn-success" name="btn-tambah"><i class="fas fa-plus-circle"></i> Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped mt-4 ml-3" style="width:96%; text-align:center;">
            <tr>
                <td>No</td>
                <td>Nama Siswa</td>
                <td>Kelas</td>
                <td>Tanggal Pembayaran</td>
                <td>Tanggal Transaksi</td>
                <td>status</td>
                <td>Foto Bukti</td>
                <?php if ($level == 1) { ?>
                    <td colspan="2">action</td>
                <?php } ?>
            </tr>
            <?php
            $batas = 4;
            extract($_GET);
            if (empty($hal)) {
                $posisi = 0;
                $hal = 1;
                $nomor = 1;
            } else {
                $posisi = ($hal - 1) * $batas;
                $nomor = $posisi + 1;
            }
            // SELECT * FROM tbtransaksi INNER JOIN tbanggota ON tbtransaksi.idanggota = tbanggota.idanggota INNER JOIN akun ON tbtransaksi.idbuku = tbbuku.idbuku

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $pencarian = trim(mysqli_real_escape_string($koneksi, $_POST['pencarian']));
                if ($pencarian != "") {
                    $query = "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON transaksi_detail.id_minggu = minggu.id_minggu INNER JOIN akun ON transaksi.id_akun = akun.id_akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas WHERE minggu.id_minggu = $date AND transaksi.id_kelas = '$kelas' AND akun.nama LIKE '%$pencarian%' ORDER BY akun.nama ASC  LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON transaksi_detail.id_minggu = minggu.id_minggu INNER JOIN akun ON transaksi.id_akun = akun.id_akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas WHERE minggu.id_minggu = $date AND transaksi.id_kelas = '$kelas' AND akun.nama LIKE '%$pencarian%' ORDER BY akun.nama ASC";
                    $no = $posisi * 1;
                } else {
                    $query = "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON transaksi_detail.id_minggu = minggu.id_minggu INNER JOIN akun ON transaksi.id_akun = akun.id_akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas WHERE minggu.id_minggu = $date AND transaksi.id_kelas = '$kelas' ORDER BY akun.nama ASC LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON transaksi_detail.id_minggu = minggu.id_minggu INNER JOIN akun ON transaksi.id_akun = akun.id_akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas WHERE minggu.id_minggu = $date AND transaksi.id_kelas = '$kelas' ORDER BY akun.nama ASC";
                    $no = $posisi * 1;
                }
            } else {
                $query = "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON transaksi_detail.id_minggu = minggu.id_minggu INNER JOIN akun ON transaksi.id_akun = akun.id_akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas WHERE minggu.id_minggu = $date AND transaksi.id_kelas = '$kelas' ORDER BY akun.nama ASC LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON transaksi_detail.id_minggu = minggu.id_minggu INNER JOIN akun ON transaksi.id_akun = akun.id_akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas WHERE minggu.id_minggu = $date AND transaksi.id_kelas = '$kelas' ORDER BY akun.nama ASC";
                $no = $posisi * 1;
            }

            //$sql="SELECT * FROM tbtranskasi ORDER BY idanggota DESC";
            $q_tampil_transaksi = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($q_tampil_transaksi) > 0) {
                while ($r_tampil_transaksi = mysqli_fetch_array($q_tampil_transaksi)) {
                    if (empty($r_tampil_transaksi['bukti_bayar']) or ($r_tampil_transaksi['bukti_bayar'] == '-')) {
                        $foto = "bayar.png";
                    } else {
                        $foto = $r_tampil_transaksi['bukti_bayar'];
                    }
            ?>

                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td>
                            <?php $id = $r_tampil_transaksi['id_transaksi']; ?>
                            <button type="button" style="border: none; background-color:rgba(0, 22, 220, 0);" data-bs-toggle="modal" data-bs-target="#exampleModal1<?= $id ?>"><?php echo $r_tampil_transaksi['nama']; ?></button>

                            <div class=" modal fade" id="exampleModal1<?= $id ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-left:-120px;">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width: 120vh;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi INNER JOIN minggu ON transaksi_detail.id_minggu = minggu.id_minggu INNER JOIN akun ON transaksi.id_akun = akun.id_akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas  WHERE transaksi.id_transaksi =$id");
                                        $data = mysqli_fetch_array($query);
                                        if (empty($data['bukti_bayar']) or ($data['bukti_bayar'] == '-')) {
                                            $foto1 = "bayar.png";
                                        } else {
                                            $foto1 = $data['bukti_bayar'];
                                        }
                                        ?>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="assets/gambar/<?php echo $foto1; ?>" width=310px height=390px class="mt-3">
                                                </div>
                                                <div class="col-md-6">
                                                    <table style="margin-left: -30px; margin-top:20%;">
                                                        <tr align="left" style="height:40px">
                                                            <td>ID Akun</td>
                                                            <td width="20px" style="padding-left: 10px; padding-right:10px;">:</td>
                                                            <td><?= $data['id_akun'] ?></td>
                                                        </tr>
                                                        <tr align="left" style="height:40px">
                                                            <td>Nama</td>
                                                            <td width="20px" style="padding-left: 10px; padding-right:10px;">:</td>
                                                            <td><?= $data['nama'] ?></td>
                                                        </tr>
                                                        <tr align="left" style="height:40px">
                                                            <td>Kelas</td>
                                                            <td width="20px" style="padding-left: 10px; padding-right:10px;">:</td>
                                                            <td><?= $data['nama_kelas'] ?></td>
                                                        </tr>
                                                        <tr align="left" style="height:40px">
                                                            <td>Tanggal Pembayaran</td>
                                                            <td width="20px" style="padding-left: 10px; padding-right:10px;">:</td>
                                                            <td><?= $data['tanggal_bayar'] ?></td>
                                                        </tr>
                                                        <tr align="left" style="height:40px">
                                                            <td>Tanggal Transaksi</td>
                                                            <td width="20px" style="padding-left: 10px; padding-right:10px;">:</td>
                                                            <td><?= $data['tanggal'] ?></td>
                                                        </tr>
                                                        <tr align="left" style="height:40px">
                                                            <td>Nominal Transaksi</td>
                                                            <td width="20px" style="padding-left: 10px; padding-right:10px;">:</td>
                                                            <td><?= $data['nominal'] ?></td>
                                                        </tr>
                                                        <tr align="left" style="height:40px">
                                                            <td>Status</td>
                                                            <td width="20px" style="padding-left: 10px; padding-right:10px;">:</td>
                                                            <td>
                                                                <?php
                                                                if ($data['status'] === 'belum bayar') {
                                                                    echo "<div class='status' style='background-color: #DB0909;'>Belum Bayar</div>";
                                                                } else if ($data['status'] === 'veirifikasi') {
                                                                    echo "<div class='status' style='background-color: #2A07FF;'>Verifikasi</div>";
                                                                } else if ($data['status'] === 'sudah bayar') {
                                                                    echo "<div class='status' style='background-color: #1A8708;'>Sudah Bayar</div>";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $r_tampil_transaksi['nama_kelas']; ?></td>
                        <td><?php echo $r_tampil_transaksi['tanggal_bayar']; ?></td>
                        <td><?php echo $r_tampil_transaksi['tanggal']; ?></td>
                        <td>
                            <?php
                            if ($r_tampil_transaksi['status'] === 'belum bayar') {
                                echo "<div class='status' style='background-color: #DB0909;'>Belum Bayar</div>";
                            } else if ($r_tampil_transaksi['status'] === 'veirifikasi') {
                                echo "<div class='status' style='background-color: #2A07FF;'>Verifikasi</div>";
                            } else if ($r_tampil_transaksi['status'] === 'sudah bayar') {
                                echo "<div class='status' style='background-color: #1A8708;'>Sudah Bayar</div>";
                            }
                            ?>
                        </td>
                        <td><img src="<?php echo "assets/gambar/" . $foto ?>" width=70px height=70px></td>
                        <td>
                            <!-- Example single danger button -->
                            <?php if ($level == 1) { ?>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <?php
                                        if ($r_tampil_transaksi['status'] === 'belum bayar' || $r_tampil_transaksi['status'] === 'veirifikasi') { ?>
                                            <li><button class="dropdown-item" onclick="bayar('<?= $r_tampil_transaksi['id_transaksi']; ?>','<?= $nominal ?>','<?= $kelas ?>','<?= $date ?>')">Bayar</button></li>
                                            <li><button class="dropdown-item" hidden onclick="belum_bayar('<?= $r_tampil_transaksi['id_transaksi']; ?>','<?= $nominal ?>','<?= $kelas ?>','<?= $date ?>')">Belum Bayar</button></li>
                                            <li><button class="dropdown-item" onclick="konfirmasi('<?= $r_tampil_transaksi['id_transaksi'] ?>','<?= $date ?>','<?= $r_tampil_transaksi['status'] ?>','<?= $nominal ?>','<?= $kelas ?>')">Hapus</button></li>
                                        <?php } else if ($r_tampil_transaksi['status'] === 'sudah bayar') { ?>
                                            <li><button class=" dropdown-item" hidden onclick="bayar('<?= $r_tampil_transaksi['id_transaksi']; ?>','<?= $nominal ?>','<?= $kelas ?>','<?= $date ?>')">Bayar</button></li>
                                            <li><button class="dropdown-item" onclick="belum_bayar('<?= $r_tampil_transaksi['id_transaksi']; ?>','<?= $nominal ?>','<?= $kelas ?>','<?= $date ?>')">Belum Bayar</button></li>
                                            <li><button class="dropdown-item" onclick="konfirmasi('<?= $r_tampil_transaksi['id_transaksi']  ?>','<?= $date ?>','<?= $r_tampil_transaksi['status'] ?>','<?= $nominal ?>','<?= $kelas ?>')">Hapus</button></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- Modal -->
            <?php $nomor++;
                }
            } else {
                echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
            } ?>
        </table>
        <?php
        if (isset($_POST['btn-cari'])) {
            if ($_POST['pencarian'] != '') {
                echo "<div style=\"float:left;\">";
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Data Hasil Pencarian: <b>$jml</b>";
                echo "</div>";
        ?>
                <div class=" pagination">
                    <?php
                    $jml_hal = ceil($jml / $batas);
                    for ($i = 1; $i <= $jml_hal; $i++) {
                        if ($i != $hal) {
                            echo "<a href=\"?p=pembayaran&minggu=$date&hal=$i\">$i</a>";
                        } else {
                            echo "<a class=\"active\">$i</a>";
                        }
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "<meta http-equiv='refresh' content='0; url=navbar.php?p=pembayaran&minggu=$date'>";
            }
        } else { ?>
            <div style="float: left;">
                <?php
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Jumlah Data : <b>$jml</b>";
                ?>
            </div>
            <div class="pagination">
                <?php
                $jml_hal = ceil($jml / $batas);
                for ($i = 1; $i <= $jml_hal; $i++) {
                    if ($i != $hal) {
                        echo "<a href=\"?p=pembayaran&minggu=$date&hal=$i\">$i</a>";
                    } else {
                        echo "<a class=\"active\">$i</a>";
                    }
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<script>
    function pesan(judul, status) {
        swal.fire({
            title: judul,
            icon: status,
            confirmButtonColor: '#6777ef',
        });
    }

    var nama = document.getElementById('nama');
    var tanggal = document.getElementById('tanggal');

    function tambah() {
        if (nama.value == "0") {
            pesan('Nama Tidak Boleh Kosong', 'warning');
            return false;
        } else if (tanggal.value == "") {
            pesan('Tanggal Tidak Boleh Kosong', 'warning');
            return false;
        }
    }

    function bayar(id, nominal, kelas, minggu) {
        window.location.href = "proses/change-bayar.php?id=" + id + "&nominal=" + nominal + "&minggu=" + minggu + "&id_kelas=" + kelas;
    }

    function belum_bayar(id, nominal, kelas, minggu) {
        window.location.href = "proses/change-belumbayar.php?id=" + id + "&nominal=" + nominal + "&minggu=" + minggu + "&id_kelas=" + kelas;
    }

    function konfirmasi(id, minggu, status, nominal, kelas) {
        swal.fire({
            title: "Hapus Data ini?",
            icon: "warning",
            closeOnClickOutside: false,
            showCancelButton: true,
            confirmButtonText: 'Iya',
            confirmButtonColor: '#6777ef',
            cancelButtonText: 'Batal',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.value) {
                window.location.href = "proses/pembayaran-hapus-proses.php?id=" + id + "&minggu=" + minggu + "&status=" + status + "&nominal=" + nominal + "&id_kelas=" + kelas;
            }
        });
    }
</script>