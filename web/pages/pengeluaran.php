<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Data Pengeluaran</span>
        <div class="notif">
            <i class="fas fa-bell n"></i>
        </div>
        <div class="setting">
            <i class="fas fa-cog s"></i>
        </div>
    </div>
    <div class="content">
        <!-- Button trigger modal -->
        <div class="row" style="width:97%;">
            <div class="col-md-8">
                <?php if ($level == 1) { ?>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    <button type="button" class="btn btn-secondary"><i class="fas fa-print"></i> Print</button>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <form class="row g-3" style="margin-left: 17%; margin-bottom:-15px;" method="POST">
                    <div class="col-auto">
                        <input type="date" name="pencarian" class="form-control" id="inputPassword2" placeholder="Nama Barang">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" style="height: 40px; padding-top:8px; width:45px; padding-left:11px;"><i class='bx bx-search-alt fs-4'></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses/pengeluaran-tambah-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class='bx bxs-dollar-circle'></i></span>
                                    <input type="text" class="form-control" id="nominal" n aria-describedby="inputGroupPrepend" placeholder="Nominal Pengeluaran" name="nominal">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" id="tanggal" n aria-describedby="inputGroupPrepend" name="tanggal">
                                    <input type="hidden" value="<?= $id ?>" name="akun">
                                    <input type="hidden" value="<?= $kelas ?>" name="kelas">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <input type="file" class="form-control" name="foto" id="foto" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        <button type="submit" class="btn btn-success" name="btn-tambah"><i class="fas fa-plus-circle"></i> Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped mt-4 ml-3" style="width:96%; text-align:center;">
            <tr>
                <td>No</td>
                <td>Nominal Pengeluaran</td>
                <td>Tanggal Pengeluaran</td>
                <td>Foto</td>
                <?php if($level == 1) { ?>
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
                    $query = "SELECT * FROM pengeluaran WHERE nama_kelas = '$kelas' AND tgl_pengeluaran LIKE '%$pencarian%' LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM pengeluaran WHERE nama_kelas = '$kelas' AND tgl_pengeluaran LIKE '%$pencarian%'";
                    $no = $posisi * 1;
                } else {
                    $query = "SELECT * FROM pengeluaran WHERE nama_kelas = '$kelas' LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM pengeluaran WHERE nama_kelas = '$kelas'";
                    $no = $posisi * 1;
                }
            } else {
                $query = "SELECT * FROM pengeluaran WHERE nama_kelas = '$kelas' LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM pengeluaran WHERE nama_kelas = '$kelas'";
                $no = $posisi * 1;
            }

            //$sql="SELECT * FROM tbtranskasi ORDER BY idanggota DESC";
            $q_tampil_transaksi = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($q_tampil_transaksi) > 0) {
                while ($r_tampil_transaksi = mysqli_fetch_array($q_tampil_transaksi)) {
                    if (empty($r_tampil_transaksi['foto']) or ($r_tampil_transaksi['foto'] == '-')) {
                        $foto = "barang.jpg";
                    } else {
                        $foto = $r_tampil_transaksi['foto'];
                    }
            ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $r_tampil_transaksi['nominal_pengeluaran']; ?></td>
                        <td><?php echo $r_tampil_transaksi['tgl_pengeluaran']; ?></td>
                        <td><img src="<?php echo "assets/gambar/" . $foto ?>" width=70px height=70px></td>
                        <?php if($level == 1) { ?>
                        <td>
                            <!-- Example single danger button -->
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="navbar.php?p=detail&id=<?= $r_tampil_transaksi['id_pengeluaran'] ?>">Detail Transaksi</a></li>
                                    <li><a class="dropdown-item" href="navbar.php?p=pengeluaran-edit&id=<?= $r_tampil_transaksi['id_pengeluaran'] ?>">Update</a></li>
                                    <li><button class="dropdown-item" onclick="konfirmasi('<?php echo $r_tampil_transaksi['id_pengeluaran']; ?>')">Delete</button></li>
                                </ul>
                            </div>
                        </td>
                        <?php } ?>
                    </tr>
            <?php $nomor++;
                }
            } else {
                echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
            } ?>
        </table>
        <?php
        if (isset($_POST['pencarian'])) {
            if ($_POST['pencarian'] != '') {
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
                            echo "<a href=\"?p=transaksi&hal=$i\">$i</a>";
                        } else {
                            echo "<a class=\"active\">$i</a>";
                        }
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "<meta http-equiv='refresh' content='0; url=navbar.php?p=pengeluaran'>";
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
                        echo "<a href=\"?p=transaksi&hal=$i\">$i</a>";
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

    var nominal = document.getElementById('nominal');
    var tanggal = document.getElementById('tanggal');
    var foto = document.getElementById('foto');

    function tambah() {
        if (nominal.value == "") {
            pesan('Nominal Tidak Boleh Kosong', 'warning');
            return false;
        } else if (tanggal.value == "") {
            pesan('Tanggal Tidak Boleh Kosong', 'warning');
            return false;
        } else if (foto.value == "") {
            pesan('Foto Tidak Boleh Kosong', 'warning');
            return false;
        }
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
                window.location.href = "proses/pengeluaran-hapus-proses.php?id=" + id;
            }
        });
    }
</script>