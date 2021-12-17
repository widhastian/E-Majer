<?php include 'proses/date.php'; ?>
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
                <?php } ?>
            </div>
            <div class="col-md-4">
                <form class="row g-3" style="margin-left:12.5%; margin-bottom:-15px;" method="POST">
                    <div class="col-auto">
                        <input type="date" name="tanggal" class="form-control" id="inputPassword2">
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
                        <form action="proses/buku-transaksi.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-calendar-alt"></i></span>
                                    <select class="form-select" id="minggu" name="minggu">
                                        <option value="0">-- Minggu Ke --</option>
                                        <option value="Minggu 1">Minggu 1</option>
                                        <option value="Minggu 2">Minggu 2</option>
                                        <option value="Minggu 3">Minggu 3</option>
                                        <option value="Minggu 4">Minggu 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" id="tanggal" n aria-describedby="inputGroupPrepend" name="tanggal">
                                    <input type="hidden" name="kelas" value="<?= $kelas ?>">
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
        <?php
        $batas = 3;
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
            $tanggal = trim(mysqli_real_escape_string($koneksi, $_POST['tanggal']));
            if ($tanggal != "") {
                $query = "SELECT * FROM minggu WHERE nama_kelas ='$kelas' AND tanggal LIKE '%$tanggal%'  ORDER BY tanggal LIMIT $posisi, $batas ";
                $queryJml = "SELECT * FROM minggu WHERE nama_kelas ='$kelas' AND tanggal LIKE '%$tanggal%'  ORDER BY tanggal";
                $no = $posisi * 1;
            } else {
                $query = "SELECT * FROM minggu WHERE nama_kelas ='$kelas' ORDER BY tanggal ASC LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM minggu WHERE nama_kelas ='$kelas' ORDER BY tanggal ASC";
                $no = $posisi * 1;
            }
        } else {
            $query = "SELECT * FROM minggu WHERE nama_kelas ='$kelas' ORDER BY tanggal ASC LIMIT $posisi, $batas";
            $queryJml = "SELECT * FROM minggu WHERE nama_kelas ='$kelas' ORDER BY tanggal ASC";
            $no = $posisi * 1;
        }

        //$sql="SELECT * FROM tbtranskasi ORDER BY idanggota DESC";
        $q_tampil_transaksi = mysqli_query($koneksi, $query);
        if (mysqli_num_rows($q_tampil_transaksi) > 0) {
            while ($row = mysqli_fetch_array($q_tampil_transaksi)) {
        ?>
                <div class="buku-transaksi">
                    <div class="row">
                        <div class="col-10">
                            <table>
                                <tr>
                                    <td><?= $row['nama_minggu'] ?></td>
                                    <td>:</td>
                                    <td><?php
                                        $tanggal = $row['tanggal'];
                                        echo convertDateDBtoIndo($tanggal) ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Siswa Bayar</td>
                                    <td>:</td>
                                    <td><?php
                                        $tanggal =  $row['tanggal'];
                                        $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM minggu INNER JOIN transaksi ON minggu.id_minggu = transaksi.id_minggu WHERE transaksi.nama_kelas = '$kelas' AND minggu.tanggal = '$tanggal' AND transaksi.status = '2'");
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($data = mysqli_fetch_array($result)) {
                                                echo $data['total'];
                                            }
                                        } else {
                                            echo "0";
                                        } ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 14rem;">Jumlah Siswa Tidak Bayar</td>
                                    <td style="width: 1rem;">:</td>
                                    <td><?php
                                        $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM minggu INNER JOIN transaksi ON minggu.id_minggu = transaksi.id_minggu WHERE transaksi.nama_kelas = '$kelas' AND minggu.tanggal = '$tanggal' AND transaksi.status = '1'");
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($data = mysqli_fetch_array($result)) {
                                                echo $data['total'];
                                            }
                                        } else {
                                            echo "0";
                                        } ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-2">
                            <a href="navbar.php?p=pembayaran&minggu=<?php echo $row['id_minggu'] ?>">
                                <div type="button" class="btn btn-primary button" style="width: 85%; margin-bottom:5px;">Detail</div>
                            </a>
                            <button type="button" class="btn btn-danger button" onclick="konfirmasi('<?= $row['id_minggu'] ?>')">Hapus</button>
                        </div>
                    </div>
                </div>
        <?php $nomor++;
            }
        } else {
            echo "<p align='center' style='margin-top:2rem; font-weight:bold;'>Data Tidak Ditemukan</p>";
        } ?>
        <?php
        if (isset($_POST['btn-cari'])) {
            if ($_POST['tanggal'] != '') {
                echo "<div style=\"float:left;\">";
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Data Hasil Pencarian: <b>$jml</b>";
                echo "</div>";
        ?>
                <div class="pagination">
                    <?php
                    $jml_hal = ceil($jml / $batas);
                    for ($i = 1; $i <= $jml_hal; $i++) {
                        if ($i != $hal) {
                            echo "<a href=\"?p=buku-transaksi&hal=$i\">$i</a>";
                        } else {
                            echo "<a class=\"active\">$i</a>";
                        }
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "<meta http-equiv='refresh' content='0; url=navbar.php?p=buku-transaksi'>";
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
                        echo "<a href=\"?p=buku-transaksi&hal=$i\">$i</a>";
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

    var minggu = document.getElementById('minggu');
    var tanggal = document.getElementById('tanggal');

    function tambah() {
        if (minggu.value == "0") {
            pesan('Pilih Minggu Yang Benar', 'warning');
            return false;
        } else if (tanggal.value == "") {
            pesan('Tanggal Tidak Boleh Kosong', 'warning');
            return false;
        }
    }

    function bayar(id, nominal, akun) {
        window.location.href = "proses/change-bayar.php?id=" + id + "&nominal=" + nominal + "&id_akun=" + akun;
    }

    function belum_bayar(id, nominal, akun) {
        window.location.href = "proses/change-belumbayar.php?id=" + id + "&nominal=" + nominal + "&id_akun=" + akun;
    }

    function konfirmasi(id) {
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
                window.location.href = "proses/buku-transaksi-hapus.php?id=" + id;
            }
        });
    }
</script>